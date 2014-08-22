<?php
/**
 * Controller Adminnews Index
 */

/**
 * Management of the news in the admin part
 *
 */
class Adminpeople_IndexController extends Sydney_Controller_Action
{
    public function init()
    {
        parent::init();

        $this->r = $this->getRequest();
        $this->view->r = $this->r;

        // IF public profile > no setup layout admin
        if ($this->r->module == 'publicms' && $this->r->controller == 'profile') {
            $this->_isService = true;
        } else {
            $this->view->headLink()->appendStylesheet($this->view->cdnurl . '/sydneyassets/styles/zendform.css');
        }

        $this->setSubtitle('People');
        $this->setSideBar('index', 'people');
        $this->layout->langswitch = true;
        $this->layout->search = true;

        if (isset($this->r->id) && preg_match('/^[0-9]{1,10}$/', $this->r->id)) {
            $this->view->id = $this->r->id;
        }

    }

    /**
     *
     * @return void
     */
    public function indexAction()
    {
        $r = $this->r;
        $groupsDb = new Usersgroups();
        $this->view->groups = $groupsDb->fetchLabelstoFlatArray(500, false);
        // define filters
        $filters = '';
        if (isset($r->searchstr)) {
            $filters .= " AND ( LOWER( CONCAT(users.fname, ' ', users.lname)) LIKE '%" . addslashes(strtolower($r->searchstr)) . "%') ";
        }
        if (isset($r->fgroup) && $r->fgroup != '') {
            $filters .= " AND users.usersgroups_id = '" . addslashes($r->fgroup) . "' ";
        }
        $sql = $this->_getQuery('people', array($filters));
        $this->view->users_id = $this->usersId;

        $this->view->people = $this->_db->fetchAll($sql);

        /**
         * load paginator
         */
        if (isset($r->context)) {
            $context = $r->context;
        } else {
            $context = 'default';
        }
        if (isset($r->filter)) {
            $filter = $r->filter;
        } else {
            $filter = '';
        }
        if (isset($r->mode)) {
            $mode = $r->mode;
        } else {
            $mode = 'thumb';
        }

        $this->view->embed = true;

        $this->view->scriptParamEmbed = $r->embed;
        $this->view->scriptParamContext = $context;
        $this->view->scriptParamFilter = $filter;
        $this->view->scriptParamMode = $mode;
    }

    /**
     *
     * @return void
     */
    public function profileAction()
    {
        $this->setSubtitle2('Profile');
        $this->setSideBar('profile', 'people');
        if (isset($this->view->id)) {
            $sql = $this->_getQuery('people', 'AND users.id = ' . $this->view->id);
            $this->view->user = $this->_db->fetchAll($sql);
        }
    }

    /**
     *
     * @return void
     */
    public function editindexAction()
    {
        // call upload action from adminfiles
        //$this->view->action('upload', 'index', 'adminfiles', array('calledBy' => 'adminpeople','peopleId' => $this->view->id));
        $this->layout->currentModule = $this->_request->getModuleName();

        $modeEdit = false;
        if (isset($this->getRequest()->id)) {
            $this->setSubtitle2('Edit');
        } else {
            $this->setSubtitle2('Create');
        }
        $this->setSideBar('edit', 'people');

        // request id
        if (isset($this->view->id)) {

            // search user
            $sql = $this->_getQuery('people', 'AND users.id = ' . $this->view->id);
            $u = $this->_db->fetchAll($sql);

            // if user exist
            if (count($u) == 1) {
                $d = array();
                $modeEdit = true;

                // get the user
                $uDB = new Users();
                $usr = $uDB->find($u[0]['id']);
                $user = $usr[0];
                //$this->view->usersForm->populate($user->toArray());
                $this->view->avatar = $user->avatar;
            } // END - if user exist
        }

        Sydney_Form::setParams(array('request' => $this->r));
        $this->view->usersForm = new UsersFormOp(null, $this->usersData['member_of_groups'], $modeEdit);

        if (isset($this->view->id)) {
            $usera = $user->toArray();
        }
        if ($modeEdit) {
            $this->view->usersForm->populate($usera);
        }

        $this->view->scriptParamModule = $this->r->module;
        $this->view->scriptParamController = $this->r->controller;
        $this->view->scriptParamId= $this->id;
        $this->view->scriptParamRootCdn = Sydney_Tools::getRootUrlCdn();
        $this->view->scriptParamSource = $this->source;
        $this->view->scriptParamPeopleId = $this->peopleid;
        $this->view->scriptParamModule2 = $this->request->module;
        $this->view->scriptParamMaxSize = Zend_Registry::get('config')->general->upload->maxsize;
        $this->view->scriptParamRootCdn2 = Sydney_Tools_Paths::getRootUrlCdn();
    }

    /**
     *
     * @return void
     */
    public function permissionsAction()
    {
        $r = $this->getRequest();
        $uid = 0;
        if (isset($r->id) && preg_match("/^[0-9]{1,100}$/", $r->id)) {
            $uid = $r->id;
        }
        $usersDB = new Users();
        $users = $usersDB->find($uid);
        if (count($users) == 1) {
            $user = $users[0];
            $this->setSubtitle2('Permissions for ' . $user->login);
            $this->setSideBar('permissions', 'people');
            $this->view->extended = false;
            if (in_array(3, $this->usersData['member_of_groups'])) {
                $this->view->extended = true;
                $form = new UsersWebsitePermisionsForm();
                $safinstancesUsers = new SafinstancesUsers();
                $data = array(
                    'id'                => $user->id,
                    'saf_id'            => $user->safinstances_id,
                    'SafinstancesUsers' => $safinstancesUsers->getSafinstancesLinkedTo($user->id)
                );
                $form->populate($data);
                $this->view->websiteForm = $form;
            }
        }
    }

    /**
     *
     * @param unknown_type $type
     * @param unknown_type $opts
     * @return string
     */
    private function _getQuery($type, $opts = array())
    {
        $sql = '';
        if (!is_array($opts)) {
            $opts = array($opts);
        }
        switch ($type) {
            case 'people':
                $sql = UsersOp::getSqlUserList($this->usersData, $opts);
                break;
        }

        return $sql;
    }

}
