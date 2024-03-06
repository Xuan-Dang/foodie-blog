<?php
class BaseController
{
    const VIEW_FOLDER_NAME  = "Views";
    const MODEL_FOLDER_NAME = "Models";

    //View:
    protected function view($path, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        $path = self::VIEW_FOLDER_NAME . "/" . str_replace(".", "/", $path) . ".php";
        require($path);
    }

    //Load model:
    protected function loadModel($modelName)
    {
        require(self::MODEL_FOLDER_NAME . "/" . $modelName . ".php");
    }
}
