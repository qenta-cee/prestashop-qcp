<?php
/*
    Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich zu behandeln.
    Jegliche Weitergabe an dritte, in welcher Form auch immer, ist unzulaessig.

    Software & Service Copyright (C) by
    Wirecard Central Eastern Europe GmbH,
    FB-Nr: FN 195599 x, http://www.wirecard.at
*/

if(!class_exists('Zend_Exception', false))
{
    require_once 'Zend/Exception.php';
}

/**
 * class for all QPay exceptions.
 * e.g. messages returned from QPay if initiation failed.
 */
final class Wirecard_CEE_QPay_Exception extends Zend_Exception
{
    
}