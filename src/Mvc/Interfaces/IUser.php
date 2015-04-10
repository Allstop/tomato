<?php
namespace Mvc\Interfaces;
interface IUser
{
    /**
     * @param $gtPost array
     * @return mixed array
     */
    public function loginCheck($gtPost);

    /**
     * @param $gtPost array
     * @return mixed ? $gtPost['name'] : '失敗';
     */
    public function create($gtPost);

    /**
     * @param $name
     * @return mixed
     */
    public function createCheck($name);
}
