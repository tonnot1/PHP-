<?php require_once 'Partials/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h1>Ajouter une tâche</h1>
            <?php \TODO\Services\Toolbox::getFlash(); ?>

            <div class="col-xs-8 col-lg-offset-2">
                <form action="#" method="post">
                    <?= $form->input('titre', 'Titre de votre tâche', ['type'=>'text','css'=>'form-control','required'=>true])  ?>

                    <?= $form->input('resume', 'Résumé de votre tâche', ['type'=>'text','css'=>'form-control','required'=>true])  ?>

                    <?= $form->input('content', 'Content de votre tâche', ['type'=>'textarea','css'=>'form-control','required'=>true])  ?>

                    <?= $form->select('idStatut', 'statut de votre tâche', $statuts, ['css'=>'form-control','required'=>false ])  ?>

                    <?= '<hr>'?>
                    <?=  '<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>' ?>

                </form>
            </div>

        </div>
    </div>
</div>


<?php require_once 'Partials/footer.php'; ?>
