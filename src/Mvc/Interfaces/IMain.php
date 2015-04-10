<?php
namespace Mvc\Interfaces;
interface IMain
{
    /**
     * @param $name
     * @return mixed
     */
    public function sessionCheck($name);

    /**
     * @param $gtlPost
     * @return mixed
     */
    public function createRecord($gtlPost);

    /**
     * @param $name
     * @return mixed
     */
    public function listRecord($name);
}
