<div class="content mt-3">

    <!-- success message -->
    <?php if (Yii::app()->user->hasFlash('missing')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> <?= Yii::app()->user->getFlash('missing'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <!-- success message -->
    <?php if (Yii::app()->user->hasFlash('success')) { ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p><?= Yii::app()->user->getFlash('success'); ?></p>
            <hr>
            <p class="mb-0">
                Click to view
                <?= CHtml::link('Output.json', '/files/output.json', ['target' => '_blank']) ?>
                <?php if (Yii::app()->user->hasFlash('error')) { ?>
                    & <?= CHtml::link('Error.json', '/files/error.json', ['target' => '_blank']) ?>
                <?php } ?>

            </p>
        </div>
    <?php } ?>

    <div class="jumbotron">
        <h1>CSV to JSON Generator</h1>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">CSV File</label>
                <input type="file" name="csv-file" id="csv-file">
                <small id="csv-file" class="form-text text-muted">File must me CSV format.</small>
            </div>

            <!-- button -->
            <button type="submit" name="json-convert-btn" class="btn btn-primary">Submit</button>

        </form>

    </div>
</div>