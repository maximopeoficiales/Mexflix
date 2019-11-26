<?php
class StatusController
{
    private $model;
    public function __construct()
    {
        $this->model = new StatusModel();
    }
    public function set($status_data = array())
    {
        return $this->model->create($status_data);
    }

    public function get($status_id = '')
    {
        return $this->model->get($status_id);
    }

    public function del($status_id = '')
    {
        return $this->model->delete($status_id);
    }

    public function __destruct()
    {
        unset($this->model);
    }
}
