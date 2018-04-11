<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the upravitor.
 */

class AclModel {

    private $acl = null;

    public function __construct() {

        $this->acl = new Nette\Security\Permission;

        $this->acl->addRole("1");
        $this->acl->addRole("2");
        $this->acl->addRole("3");
        $this->acl->addRole("4");
        $this->acl->addResource("dashboard");
        $this->acl->addResource("sign");


        $this->acl->allow(array("1", "2", "3"), "dashboard");


    }

    public function isAllowed($role, $presenter, $akce) {

        return $this->acl->isAllowed($role, $presenter, $akce);
    }

}
