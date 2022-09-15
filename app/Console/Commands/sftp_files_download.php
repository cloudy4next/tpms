<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\setting_name_location;
use App\Models\sftp_file_manage;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use phpseclib3\Net\SFTP;


class sftp_files_download extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dwonsftp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $credentials = setting_name_location::where('admin_id', $this->admin_id)->first();

        if ($credentials) {
            if ($credentials->ftp_username != null && $credentials->ftp_password != null) {
                $cred = [
                    'driver' => 'sftp',
                    'host' => 'ftp10.officeally.com',
                    'username' => $credentials->ftp_username,
                    'password' => $credentials->ftp_password,
                    'port' => '22',
                    'timeout' => '10',
                ];
            } else {
                exit();
            }
        }


//        $check_outbond_dir = public_path('sftp/outbound/' . $credentials->ftp_username);
//        if (!File::isDirectory($check_outbond_dir)) {
//            File::makeDirectory($check_outbond_dir, 0777, true, true);
//        }


        $driver = Storage::createSFtpDriver($cred);

        if ($driver->exists('/outbound/')) {
            $files = collect($driver->listContents('/outbound/', false))->toArray();
            foreach ($files as $file) {
                if ($file["type"] == "file") {
                    $file_name = $file["basename"];
                    $path = public_path('/');
                    if (!Storage::disk('custom')->exists($file_name)) {
                        $contents = $driver->get($file["path"]);
                        Storage::disk('custom')->put($file_name, $contents);
                        $data = new sftp_file_manage;
                        $data->admin_id = $this->admin_id;
                        $data->file_name = $file_name;
                        $data->receive_date = Carbon::now();
                        $data->process_date = Carbon::createFromTimestamp($file["timestamp"])->format('Y-m-d H:i:s');
                        $data->save();
                    }
                }
            }
        } else {
            return "Not connected";
        }
    }
}
