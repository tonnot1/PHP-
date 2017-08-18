<?php
require_once 'Partials/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">

            <h1>Bienvenue au ToDoList</h1>
            <h2>Voici les tasks</h2>
            <?php \TODO\Services\Toolbox::getFlash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 ">

            <?php require_once 'Partials/menu_task.php'  ?>

            <table  id="example" class="table table-responsive table-striped table-bordered ">
            <thead>
            <tr>
                <th>Titre</th>
                <th>Resume</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            </thead>
                <tbody>
                <?php   foreach($tasks as $task)    :?>
                <tr>
                    <td><?= $task->getTitre() ?></td>
                    <td><?= $task->getResume() ?></td>
                    <td><?= $task->libelle ?></td>
                    <td>
                        <a href="index.php?action=Task/manageTask&id_task=<?=$task->getIdTask()?>" class="btn btn-xs btn-warning">Modifier</a>
                        <a href="index.php?action=Task/Delete&id=<?= $task->getIdTask() ?>" class="btn btn-xs btn-danger" onclick="return confirm('Etes-vous sûr?')">Supprimer</a>

                    </td>
                </tr>
                <?php    endforeach;   ?>
                </tbody>

            </table>
        </div>
</div>


</div>

<?php require_once 'Partials/footer.php'  ?>