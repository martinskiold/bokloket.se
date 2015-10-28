<?php
    //Genererar ett randomiserat salt med 22 tecken.
	function generateSalt() {
        return substr(sha1(mt_rand()),0,22);
    }
?>