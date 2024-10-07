<!-- views/index.blade.php -->
@extends('master') <!-- Assurez-vous que le fichier master.blade.php existe -->

@section('title', 'Liste des Personnes')

@section('main')
    <h1>Liste des Personnes</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        </thead>
        <tbody>
        @foreach($personnes as $personne)
            <tr>
                <td>{{ $personne->getId() }}</td>
                <td>{{ $personne->getNom() }}</td>
                <td>{{ $personne->getPrenom() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
