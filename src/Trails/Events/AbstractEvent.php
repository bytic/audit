<?php

namespace ByTIC\Audit\Trails\Events;

/**
 * Class AbstractEvent
 * @package ByTIC\Audit\Trails\Events
 */
abstract class AbstractEvent
{
    // Log types
    public const CREATE = 'CREATE'; // PUT
    public const RETRIEVE = 'RETRIEVE'; // GET
    public const UPDATE = 'UPDATE'; // POST
    public const DELETE = 'DELETE'; // DELETE
    public const ACCESS = 'ACCESS'; // View a protected/audited record
    public const ADD = 'ADD'; // Add ORM relationship (ORM::add())
    public const REMOVE = 'REMOVE'; // Remove ORM relationship (ORM::remove())
    public const UPLOAD = 'UPLOAD'; // Upload a file
    public const DOWNLOAD = 'DOWNLOAD'; // Downloaded a file
    public const EMAIL = 'EMAIL'; // Sent an email
}
