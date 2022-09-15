<h6 class="common-title mt-4">Scrubbing Rules</h6>
<table class="table table-sm table-bordered c_table">
    <thead>
        <tr>
            <th style="width:30%">Rule</th>
            <th style="width:50%">Description/Message</th>
            <th style="width:10%">Run Rule</th>
            <th style="width:10%">Prevent Next stage</th>
        </tr>
    </thead>
    <tbody>
        @foreach($result as $rules)
        <tr>
            <td title="{{$rules["rule"]}}">{{$rules["rule"]}}</td>
            <td title="{{$rules["description"]}}">{!! $rules["description"] !!}</td>
            <td>
                <div class="custom-control custom-switch">
                    @if ($rules["run"] == 1)
                        <input type="checkbox" value="1" scrubbing-id="{{$rules["id"]}}" name="run"
                        class="custom-control-input run_col"
                        id="run{{$rules['id']}}" checked>
                        <label class="custom-control-label" for="run{{$rules['id']}}">Yes</label>
                    @else
                        <input type="checkbox" value="2" scrubbing-id="{{$rules["id"]}}" name="run"
                        class="custom-control-input run_col" id="run{{$rules['id']}}"
                        >
                        <label class="custom-control-label" for="run{{$rules['id']}}">No</label>
                    @endif
                </div>
            </td>
            <td>
                <div class="custom-control custom-switch">
                    @if ($rules["prevent"] == 1)
                    <input type="checkbox" name="prevent_session" value="1"
                    class="custom-control-input prevent_col" id="prevent{{$rules['id']}}"
                    checked>
                    <label class="custom-control-label"
                    for="prevent{{$rules['id']}}">Yes</label>
                    @else
                    <input type="checkbox" name="prevent_session" value="2"
                    class="custom-control-input prevent_col" id="prevent{{$rules['id']}}"
                    >
                    <label class="custom-control-label"
                    for="prevent{{$rules['id']}}">No</label>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Select -->
<div class="d-flex">
    <div class="align-self-end">
        <button type="button" class="btn btn-sm btn-primary mr-2" id="save_scrubbing_btn">Save</button>
    </div>
</div>
</div>