<?php
class AdminController extends Controller
{
    
    protected $controls = array(
        'pages' => 'Page',
        'orders' => 'Order',
        'categories' => 'Category',
        'goods' => 'Good'
    );

    public $title = 'admin';
    
    public function index($data)
    {
        return array('controls' => $this->controls);


    }

    public function control($data)
    {
        // Сохранение
        $actionId = $this->getActionId($data);
        if ($actionId['action'] === 'save') {
            $fields = array();
            foreach ($_POST as $key => $value) {
                $field = explode('_', $key, 2);
                if ($field[0] == $actionId['id']) {
                    $fields[$field[1]] = $value;

                }
            }
        }

        if ($actionId['action'] === 'create') {
            $fields = array();
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 4) == 'new_') {
                    $fields[str_replace('new_', '', $key)] = $value;
                }
            }
        }

        switch($actionId['action']) {
            case 'create':
                $query = 'INSERT INTO ' . $data['id'] . ' ';
                $keys = array();
                $values = array();
                foreach ($fields as $key => $value) {
                    $keys[] = $key;
                    $values[] = '"' . $value . '"';
                }

                $query .= ' (' . implode(',', $keys) . ') VALUES ( ' . implode(',', $values) . ')';
                db::getInstance()->Query($query);
                break;
            case 'save':
                $query = 'UPDATE ' . $data['id'] . ' SET ';
                ;
                foreach ($fields as $field => $value) {
                    $query .= $field . ' = "' . $value . '",';
                }
                $query = substr($query, 0, -1) . ' WHERE id = :id';
                db::getInstance()->Query($query, array('id' => $actionId['id']));
                break;
            case 'delete':
                db::getInstance()->Query('UPDATE ' . $data['id'] . ' SET status=:status WHERE id = :id', array('id' => $actionId['id'], 'status' => Status::Deleted));
                break;
        }
        $fields = db::getInstance()->Select('desc ' . $data['id']);
        $_items = db::getInstance()->Select('select * from ' . $data['id']);
        $items = array();
        foreach ($_items as $item) {
            $items[] = new $this->controls[$data['id']]($item);
        }

        return array('fields' => $fields, 'items' => $items);
    }

    protected function getActionId($data)
    {
        foreach ($_POST as $key => $value) {
            if (strpos($key, '__save_') === 0) {
                $id = explode('__save_', $key);
                $id = $id[1];
                $action = 'save';
                break;
            }
            if (strpos($key, '__delete_') === 0) {
                $id = explode('__delete_', $key);
                $id = $id[1];
                $action = 'delete';
                break;
            }
            if (strpos($key, '__create') === 0) {
                $action = 'create';
                $id = 0;
            }
        }
        return array('id' => $id, 'action' => $action);
    }
}