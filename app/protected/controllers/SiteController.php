<?php

class SiteController extends Controller
{
    /* set default layout */
    public $layout = '/layouts/column_main';

    public function actionIndex()
    {

        if (isset($_POST[ 'json-convert-btn' ])) {
            $this->jsonify();
        }

        $this->render('index');
    }

    public function jsonify()
    {

        /* blank warning message */
        if (!$_FILES[ "csv-file" ][ "size" ]) {
            Yii::app()->user->setFlash('missing', 'File cannot be blank.');
            $this->redirect(['index']);
        }

        $file = fopen($_FILES[ "csv-file" ][ "tmp_name" ], "r");

        $count = 0;
        $header = [];
        while (($row = fgetcsv($file, 10000, ",")) !== false) {

            // get header
            if ($count == 0) {

                $header = Csvjson::getHeaderRow($row, $header);

            } else {

                /* preset blank array */
                $row_data = [];
                $row_error = [];

                /* loop through each row */
                foreach ($row as $index => $value) {

                    /* identify field with index */
                    $field = $header[ $index ];

                    /* get output */
                    $row_data = Csvjson::getCsvJsonOutput($row_data, $field, $value);

                    /* get error */
                    $row_error = Csvjson::getCsvJsonError($row_error, $field, $value);
                }

                /* catch result */
                $data [] = $row_data;

                /* catch error */
                if ($row_error) {
                    $errors [] = $row_error;
                }
            }
            $count++;
        }


        /* output json file */
        $json_file = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '../files/output.json';
        $json_data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($json_file, $json_data);

        /* error json file */
        $json_file = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '../files/error.json';
        $json_data = json_encode($errors, JSON_PRETTY_PRINT);
        file_put_contents($json_file, $json_data);

        /* set output flash message */
        if ($data) {
            Yii::app()->user->setFlash('success', 'Json file with ' . $count . ' rows successfully generated.');
        }

        /* set error flash message */
        if ($errors) {
            Yii::app()->user->setFlash('error', 'Json file successfully generated.');
        }

        $this->redirect(['index']);
    }
}