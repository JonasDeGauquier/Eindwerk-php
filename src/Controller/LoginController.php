<?php
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Network\Session;
use Cake\Utility\Security;
use PDO;

/**
 * Login Controller
 *
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $login = $this->paginate($this->Login);

        $this->set(compact('login'));
    }

    /**
     * View method
     *
     * @param string|null $id Login id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $login = $this->Login->get($id, [
            'contain' => []
        ]);

        $this->set('login', $login);
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        if($this->Auth->user()) {
            if ((new \Cake\Network\Session)->check('personeel')) {
                (new \Cake\Network\Session)->delete('personeel');
            }
            return $this->redirect($this->Auth->redirectUrl('/full-calendar'));
        }

        if ($this->request->is('post')) {
            if ($this->request->session()->read('Auth.LoggedIn') != null){
                $session = $this->request->session();
                $session->destroy();
            }

            $username = $this->request->data('username');
            $password = $this->request->data('password');

            Security::setHash('md5');
            $hashed = Security::hash($password, 'md5');

            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute("SELECT * FROM login WHERE username = '$username' AND password = '$hashed' LIMIT 1 ");
            $results = $stmt ->fetch(PDO::FETCH_ASSOC);

            $databaseUsername = $results['username'];
            $databasePassword = $results['password'];

            if ($username == $databaseUsername && $hashed == $databasePassword){
                $user = $username . ' ' . $hashed;
            } else{
                $this->Flash->error(__('Invalid email or password, try again'));
                return;
            }

            if ($user) {
                $this->Auth->setUser($user);

                $userId = $results['user_id'];
                $stmt2 = $conn->execute("SELECT rol_id FROM personeel WHERE id = '$userId' LIMIT 1 ");
                $queryResult = $stmt2 ->fetch(PDO::FETCH_ASSOC);

                $rolId = $queryResult['rol_id'];

                $session = $this->request->session();
                (new \Cake\Network\Session)->write('Rol', $rolId);
                (new \Cake\Network\Session)->write('User', $userId);


                return $this->redirect($this->Auth->redirectUrl('/full-calendar'));
            }

            $this->Flash->error(__('Invalid email or password, try again'));
        }
    }

    public function logout()
    {
        $session = $this->request->session();
        $session->destroy();
        return $this->redirect($this->Auth->logout());
    }

}
