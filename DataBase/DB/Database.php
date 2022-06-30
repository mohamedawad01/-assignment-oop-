<?php

interface DataBase
{
	public function select(string $query):array;
	public function selectOne(string $query, $col, $condition):array;
	public function insert(string $query):bool;
	public function update(string $query):bool;
	public function delete(string $query):bool;
}