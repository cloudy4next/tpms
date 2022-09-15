<?php

namespace App\Console\Commands;

use App\Models\setting_name_location;
use App\Models\sftp_file_manage;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Net\SFTP;
use File;

class SftpFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:sftp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'download and upload from sftp';

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

        $credentials = setting_name_location::select('id', 'admin_id', 'ftp_username', 'ftp_password')->get();

        foreach ($credentials as $creden) {

            $folderName=$creden->ftp_username.$creden->admin_id;

            if ($creden->ftp_username != null && $creden->ftp_password != null) {
                $cred = [
                    'driver' => 'sftp',
                    'host' => 'ftp10.officeally.com',
                    'username' => $creden->ftp_username,
                    'password' => $creden->ftp_password,
                    'port' => '22',
                    'timeout' => '10',
                ];
            } else {
                continue;
            }

            $check_outbond_dir = public_path('sftp/outbound/' . $folderName);
            if (!File::isDirectory($check_outbond_dir)) {
                File::makeDirectory($check_outbond_dir, 0777, true, true);
            }

            try {

                $driver = Storage::createSFtpDriver($cred);

                if ($driver->exists('/outbound/')) {
                    $files = collect($driver->listContents('/outbound/', false))->toArray();
                    foreach ($files as $file) {
                        if ($file["type"] == "file") {
                            $file_name = $file["basename"];
                            $path='/'.$folderName.'/'.$file_name;
                            $check=sftp_file_manage::where('file_name',$path)->first();
                            if(!$check){
                                if (!File::exists(public_path('sftp/outbound'.$path))) {
                                    $contents = $driver->get($file["path"]);
                                    Storage::disk('custom')->put($path, $contents);
                                    // Log::info("File Stored - ".$folderName);
                                }
                                else{
                                    // Log::info("Already in folder - ".$folderName);
                                }
                                
                                $data = new sftp_file_manage;
                                $data->admin_id = $creden->admin_id;
                                $data->file_name = $path;
                                $data->receive_date = Carbon::now();
                                $data->process_date = Carbon::createFromTimestamp($file["timestamp"])->format('Y-m-d H:i:s');
                                $data->save();
                                // Log::info("Data saved - ".$folderName);

                            }
                            else{
                                // Log::info("Already in database - ".$folderName);
                            }
                        }
                    }
                } else {
                    continue;
                }
            }
            catch (\Exception $e) {
                continue;
            }
        }


    }
}
