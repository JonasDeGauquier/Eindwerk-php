<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Personeel Controller
 *
 * @property \App\Model\Table\PersoneelTable $Personeel
 *
 * @method \App\Model\Entity\Personeel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PersoneelController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Adres', 'Rol']
        ];
        $personeel = $this->paginate($this->Personeel->find('all', array('conditions'=>array('Personeel.actief'=>true))));

        $this->set(compact('personeel'));
    }

    /**
     * View method
     *
     * @param string|null $id Personeel id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personeel = $this->Personeel->get($id, [
            'contain' => ['Adres', 'Rol']
        ]);

        $this->set('personeel', $personeel);
    }

    public function planning($id = null)
    {
        (new \Cake\Network\Session)->write('personeel', $id);
        $this->redirect("/full-calendar");
    }

    /**
     * @param null $id
     */
    public function allCalenders($id=null) {
        $personeel = $this->Personeel->find('all', array('conditions'=>array('Personeel.actief'=>true)));

        $this->set('personeel', $personeel);

    }
}
