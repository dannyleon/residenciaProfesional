@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="container" style="margin-top: 8%;">
  <div class="col-md-6 col-md-offset-3">
    <div class="row">
      <div id="logo" class="text-center">
        <h1>This is Logo</h1><p>Slogan of thematic</p>
      </div>
      <form role="form" id="form-buscar">
        <div class="form-group">
          <div class="input-group">
            <input id="1" class="form-control" type="text" name="search" placeholder="Search..." required/>
            <span class="input-group-btn">
              <button class="btn btn-success" type="submit">
                <i class="glyphicon glyphicon-search" aria-hidden="true"></i> Search
              </button>
            </span>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection
