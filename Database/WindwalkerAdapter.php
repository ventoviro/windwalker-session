<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\Session\Database;

use Windwalker\Database\Driver\AbstractDatabaseDriver;

/**
 * The WindwalkerAdapter class.
 *
 * @since  2.0
 */
class WindwalkerAdapter extends AbstractDatabaseAdapter
{
    /**
     * Property db.
     *
     * @var  \Windwalker\Database\Driver\AbstractDatabaseDriver
     */
    protected $db = null;

    /**
     * Class init.
     *
     * @param AbstractDatabaseDriver $db
     * @param array                  $options
     */
    public function __construct(AbstractDatabaseDriver $db, $options = [])
    {
        parent::__construct($db, $options);
    }

    /**
     * read
     *
     * @param string|int $id
     *
     * @return  string
     */
    public function read($id)
    {
        // Get the session data from the database table.
        $query = $this->db->getQuery(true);
        $query->select($this->db->quoteName($this->options['data_col']))
            ->from($this->db->quoteName($this->options['table']))
            ->where($this->db->quoteName($this->options['id_col']) . ' = ' . $this->db->quote($id));

        $this->db->setQuery($query);

        return (string)$this->db->loadResult();
    }

    /**
     * write
     *
     * @param string|int $id
     * @param string     $data
     *
     * @return  boolean
     */
    public function write($id, $data)
    {
        $writer = $this->db->getWriter();

        $data = [
            $this->options['data_col'] => $data,
            $this->options['time_col'] => (int)time(),
            $this->options['id_col'] => $id,
        ];

        $writer->updateOne($this->options['table'], $data, $this->options['id_col']);

        if ($writer->countAffected()) {
            return true;
        }

        $writer->insertOne($this->options['table'], $data, $this->options['id_col']);

        return true;
    }

    /**
     * destroy
     *
     * @param string|int $id
     *
     * @return  boolean
     */
    public function destroy($id)
    {
        $query = $this->db->getQuery(true);
        $query->delete($this->db->quoteName($this->options['table']))
            ->where($this->db->quoteName($this->options['id_col']) . ' = ' . $this->db->quote($id));

        // Remove a session from the database.
        $this->db->setQuery($query);

        return (boolean)$this->db->execute();
    }

    /**
     * gc
     *
     * @param string $past
     *
     * @return  bool
     */
    public function gc($past)
    {
        $query = $this->db->getQuery(true);
        $query->delete($this->db->quoteName($this->options['table']))
            ->where($this->db->quoteName($this->options['time_col']) . ' < ' . $this->db->quote((int)$past));

        // Remove expired sessions from the database.
        $this->db->setQuery($query);

        return (boolean)$this->db->execute();
    }
}
