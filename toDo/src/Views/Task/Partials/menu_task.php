<hr>
<ul class="nav nav-pills">

  <li role="presentation" class="active"><a href="index.php?action=Task/manageTask">Ajouter une tache</a></li>


    <?php foreach ($statuts as $statut):?>

  <li role="presentation">
      <a href="index.php?action=Task/showAll&id_statut=<?= $statut->getIdStatut()?>"><?= $statut->getLibelle()?></a>
  </li>

    <?php endforeach ?>


</ul>


<hr>