@extends('layouts.app')

@section('title', 'Accueil - Jeu de Rôle')

@section('content')
    <h1>Bienvenue dans notre univers de jeu de rôle !</h1>
    <p> Ce jeux se déroule sur notre serveur discord ! Vous avancez dans une sorte de "Donjon" un peu spécial contrôler
        et imaginé par le MJ. </p>

    <h2>Les règles :</h2>
    <h3>Les combats !</h3>
    <p>C'est simple, si on rentre en mode combat,un lancer de dé sera lancer par tous pour l'ordre de jeux. Quand c'est
        votre tour, vous
        avez 6 secondes pour jouer, c'est à dire que vous devez décrire votre action,et lancer votre modificateur en
        conséquence ! </p>
    <h3>Les modificateurs</h3>
    <h3>Les compétences</h3>
    <h3>Les armes & armures</h3>
    <p> Les armes et armures sont des objets qui sont équipés d'office dans votre section personnage, ils influent ou
        non vos modificateur.
        Quand une arme donne "+2 à l'attaque" et que vous la possédez, votre modificateur d'attaque aura donc +2 !
        Si vous achetez plusieurs épée, ou une épée et un arc, il n'est malheureusement pas possible de profiter de tout
        leurs avantage meme si le contraire
        est afficher sur votre personnage.
        Vous pouvez avoir deux armes "cohérentes" c'est à dire une épée et un baton, ou un épée un bouclier, un grimoire
        avec un baton ect..
        Pareil pour l'armure, avoir deux armures différente n'est pas possible. (un jour peut-être arme a une main &
        deux mains ?)</p>
    <h4>Grimoire & baton</h4>
    <p>Les grimoires et les batons sont assez lié, un baton élémentaire permet d'effectuer de la magie qui correspond à
        l'élément du baton, et le grimoire augmente les attaques magiques !
        tant qu'à lui est spécial puisqu'il augmente vos attaques magique seulement ! mais c'est très fort car il reste
        dans votre sacoche et ne prend donc pas de mains, vous pouvez donc avoir un baton,une épée et un grimoire
        (attention votre attaque prendra en compte le grimoire ET l'arme ! Soit vous lancez un sort, soit vous attaquer,
        sauf si vous trouvez une solution pour utiliser les deux) !
        mais vous pouvez malheureusement n'en possédez que un seul (petite sacoche) !
    </p>

@endsection
