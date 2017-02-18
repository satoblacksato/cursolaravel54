<?php
namespace App\Facades;

class AlertManager{
	public function  message($data,$type){
		return session()->flash('alertmanager',compact('data','type'));
	}

	public function success($data){
		$type='success';
		return session()->flash('alertmanager',compact('data','type'));
	}
	public function info($data){
		$type='info';
		return session()->flash('alertmanager',compact('data','type'));
	}
	public function warning($data){
		$type='warning';
		return session()->flash('alertmanager',compact('data','type'));
	}
	public function danger($data){
		$type='danger';
		return session()->flash('alertmanager',compact('data','type'));
	}


	public function render(){
		if(session('alertmanager')){
			return view()->make('componentes.alertmanager',session('alertmanager'));
		}
	}
}
