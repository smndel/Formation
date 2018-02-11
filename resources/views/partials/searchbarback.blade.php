    <div class="col-md-4">
        <form action="{{route('post.search')}}" method="POST" role="search" class="col-md-12">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Recherche" style="height: 50px;"> 
                    <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" style="height: 50px;">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>

                </span>
            </div>
        </form>
        @if($errors->has('q'))<span class="error" style="color : red;">{{$errors->first('q')}}</span>@endif
    </div>