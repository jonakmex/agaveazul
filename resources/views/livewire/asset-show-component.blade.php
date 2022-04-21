<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <p><b>Id</b></p>
                    <p><b>Unit id</b></p>
                    <p><b>Description</b></p>
                    <p><b>Type</b></p>
                </div>
                <div class="col">
                    <p>{{$assetId}}</p>
                    <p>{{$unitId}}</p>
                    <p>{{$description}}</p>
                    <p>{{$type}}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{route('asset.index',['unitId'=>$unitId])}}">
                <x-adminlte-button label="Back"/>
            </a>
            <a href="{{route('asset.edit',$assetId)}}" class="ml-2"> 
                <x-adminlte-button label="Edit" theme="primary"/>
            </a>
        </div>
    </div>
</div>
