{{-- views/formulaire.blade.php --}}
@extends('master')

@section('title', $titre)

@section('main')
    <h1>Saisie d'un formulaire</h1>

    <form method="post" action="/formulaire?action=ajout&user=Robert Duchmol">
        <fieldset>
            <legend>Un formulaire</legend>
            <div>
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom" placeholder="Nom du contact">
            </div>
            <div>
                <label for="prenom">Prénom : </label>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom du contact">
            </div>
            <button type="submit" class="btn btn-success">Valider</button>
        </fieldset>
    </form>
@endsection
