<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the upravitor.
 */

class AclModel {

    private $acl = null;

    const ROLE_MEMBER = '1';
    const ROLE_MANAGER = '2';
    const ROLE_TESTER = '3';
    const ROLE_CUSTOMER = '4';

    public function __construct() {

        $this->acl = new Nette\Security\Permission;

        $this->acl->addRole(self::ROLE_MEMBER);
        $this->acl->addRole(self::ROLE_MANAGER);
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

        $this->acl->allow(self::ROLE_CUSTOMER, "request", array("detail", "default"));
        $this->acl->allow(self::ROLE_CUSTOMER, "case", array("detail", "approval"));
        $this->acl->allow(self::ROLE_CUSTOMER, "user", array("profile", "edit"));
        $this->acl->allow(self::ROLE_MEMBER, "user", array("profile", "edit"));


        $this->acl->allow(self::ROLE_TESTER, "user", array("profile", "edit"));
        $this->acl->allow(self::ROLE_TESTER, "case", array("add", "default","detail","edit"));
        $this->acl->allow(self::ROLE_TESTER, "execution", array("default","detail","run"));
        $this->acl->allow(self::ROLE_TESTER, "plan", array("default","detail"));
        $this->acl->allow(self::ROLE_TESTER, "set", array("add","default","detail","edit"));
        $this->acl->allow(self::ROLE_TESTER, "request", array("detail", "default"));


        $this->acl->allow(self::ROLE_MANAGER, "dashboard", array("all", "default"));
        $this->acl->allow(self::ROLE_MANAGER, "case", array("add", "approval","default","detail","edit"));
        $this->acl->allow(self::ROLE_MANAGER, "execution", array("default","detail","run"));
        $this->acl->allow(self::ROLE_MANAGER, "plan", array("default","detail"));
        $this->acl->allow(self::ROLE_MANAGER, "project", array("add"));
        $this->acl->allow(self::ROLE_MANAGER, "request", array("default","detail"));
        $this->acl->allow(self::ROLE_MANAGER, "set", array("add","default","detail","edit"));
        $this->acl->allow(self::ROLE_MANAGER, "sign", array("out"));
        $this->acl->allow(self::ROLE_MANAGER, "user", array("profile","management","edit"));
        $this->acl->allow(self::ROLE_MANAGER, "setting", array("default"));





    }

    public function isAllowed($role, $presenter, $action) {

        return $this->acl->isAllowed($role, $presenter, $action);
    }

}
