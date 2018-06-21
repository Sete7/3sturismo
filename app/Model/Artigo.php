<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Artigo
 *
 * @author arte1
 */
class Artigo {
   private $cod;
   private $titulo;
   private $url;
   private $conteudo;
   private $thumb;
   private $data;
   private $chaves;
   private $status;
   
   function getCod() {
       return $this->cod;
   }

   function getTitulo() {
       return $this->titulo;
   }

   function getUrl() {
       return $this->url;
   }

   function getConteudo() {
       return $this->conteudo;
   }

   function getThumb() {
       return $this->thumb;
   }

   function getData() {
       return $this->data;
   }

   function getChaves() {
       return $this->chaves;
   }

   function getStatus() {
       return $this->status;
   }

   function setCod($cod) {
       $this->cod = $cod;
   }

   function setTitulo($titulo) {
       $this->titulo = $titulo;
   }

   function setUrl($url) {
       $this->url = $url;
   }

   function setConteudo($conteudo) {
       $this->conteudo = $conteudo;
   }

   function setThumb($thumb) {
       $this->thumb = $thumb;
   }

   function setData($data) {
       $this->data = $data;
   }

   function setChaves($chaves) {
       $this->chaves = $chaves;
   }

   function setStatus($status) {
       $this->status = $status;
   }



}
