<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/12/19
 * Time: 6:41 PM
 */

namespace App\Services;

interface IChallengeService extends IService
{

    public function change_name($id, $name);

    /**
     * @param $id
     * @return mixed
     */
    //public function disable($id);

    /**
     * @param $id
     * @return mixed
     */
    //public function activate($id);

    public function change_status($id, $status);


    public function all_by_active($keyword);

    // 1, 2, 3
    public function all_by_status($keyword, $statuses);

}