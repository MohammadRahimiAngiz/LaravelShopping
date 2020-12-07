<form>
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" name="search" value="{{request('search')}}"
               placeholder="Search">
        <div class="input-group-btn">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
