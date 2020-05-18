<?php
/**
 * AddressController
 * @package admin-me-setting-address
 * @version 0.0.1
 */

namespace AdminMeSettingAddress\Controller;

use LibForm\Library\Form;
use LibForm\Library\Combiner;
use UserAddress\Model\UserAddress as UAddress;

class AddressController extends \AdminMeSetting\Controller
{
    public function updateAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);

        $form = new Form('admin.me.setting.address');

        $params = [
            '_meta' => [
                'title' => 'Address'
            ],
            'form'  => $form,
            'success' => false
        ];

        $address = UAddress::getOne(['user'=>$this->user->id]);
        if(!$address){
            $id = UAddress::create(['user'=>$this->user->id]);
            $address = UAddress::getOne(['user'=>$this->user->id]);
        }

        $c_opts = [
            'country'   => [null, null, 'format', 'active', 'name'],
            'state'     => [null, null, 'format', 'active', 'name'],
            'city'      => [null, null, 'format', 'active', 'name'],
            'district'  => [null, null, 'format', 'active', 'name'],
            'village'   => [null, null, 'format', 'active', 'name'],
            'zipcode'   => [null, null, 'format', 'active', 'name']
        ];
        $combiner = new Combiner($address->id, $c_opts, 'user-address');
        $address  = $combiner->prepare($address);

        $params['opts'] = $combiner->getOptions();

        if(!($valid = $form->validate($address)) || !$form->csrfTest('noob'))
            return $this->resp('me/setting/address', $params);

        foreach($c_opts as $key => $opts)
            $valid->$key = $valid->$key ?? NULL;
        
        UAddress::set((array)$valid, ['id'=>$address->id]);

        $this->addLog([
            'user'   => $this->user->id,
            'object' => $address->id,
            'parent' => $this->user->id,
            'method' => 2,
            'type'   => 'user-address',
            'original' => $address,
            'changes'  => $valid
        ]);

        $params['success'] = true;

        return $this->resp('me/setting/address', $params);
    }
}