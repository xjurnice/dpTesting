<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the upravitor.
 */

class AclModel {

    private $acl = null;

    const ROLE_MEMBER = '1';
    const ROLE_ADMIN = '2';
    const ROLE_TESTER = '3';
    const ROLE_CUSTOMER = '4';

    public function __construct() {

        $this->acl = new Nette\Security\Permission;

        $this->acl->addRole(self::ROLE_MEMBER);
        $this->acl->addRole(self::ROLE_ADMIN);
        $this->acl->addRole(self::ROLE_TESTER);
        $this->acl->addRole(self::ROLE_CUSTOMER);
        $this->acl->addResource("dashboard");
        $this->acl->addResource("sign");
        $this->acl->addResource("execution");
        $this->acl->addResource("plan");
        $this->acl->addResource("project");
        $this->acl->addResource("request");
        $this->acl->addResource("set");
        $this->acl->addResource("user");
        $this->acl->addResource("case");
        $this->acl->addResource("setting");

        $this->acl->allow(self::ROLE_MEMBER, "dashboard", array("all", "default"));
        $this->acl->allow(self::ROLE_TESTER, "dashboard", array("all", "default"));
        $this->acl->allow(self::ROLE_CUSTOMER, "dashboard", array("all", "default"));
        $this->acl->allow(self::ROLE_MEMBER, "sign", array("out"));
        $this->acl->allow(self::ROLE_TESTER, "sign", array("out"));
        $this->acl->allow(self::ROLE_CUSTOMER, "sign", array("out"));

        $this->acl->allow(self::ROLE_MEMBER, "user", array("edit"));


        $this->acl->allow(self::ROLE_ADMIN, "dashboard", array("all", "default"));
        $this->acl->allow(self::ROLE_ADMIN, "case", array("add", "approval","default","detail","edit"));
        $this->acl->allow(self::ROLE_ADMIN, "execution", array("default","detail","run"));
        $this->acl->allow(self::ROLE_ADMIN, "plan", array("default","detail"));
        $this->acl->allow(self::ROLE_ADMIN, "project", array("add"));
        $this->acl->allow(self::ROLE_ADMIN, "request", array("default","detail"));
        $this->acl->allow(self::ROLE_ADMIN, "set", array("add","default","detail","edit"));
        $this->acl->allow(self::ROLE_ADMIN, "sign", array("out"));
        $this->acl->allow(self::ROLE_ADMIN, "user", array("profile","management","edit"));
        $this->acl->allow(self::ROLE_ADMIN, "setting", array("default"));





    }

    public function isAllowed($role, $presenter, $action) {

        return $this->acl->isAllowed($role, $presenter, $action);
    }

}
