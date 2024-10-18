@extends('layouts.app')

@section('content')
    <h1>Identifiez-vous</h1>
    <form action="{{ route('marchand.login.post') }}" method="POST"> <!-- POST method -->
        @csrf
        <div class="form-group">
            <label for="code_identification">Code d'identification :</label>
            <input type="text" name="code_identification" id="code_identification" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
@endsection
