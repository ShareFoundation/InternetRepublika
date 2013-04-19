<?php


/**
 * This class defines the structure of the 'session' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Feb 19 16:24:41 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.session.map
 */
class SessionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.session.map.SessionTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('session');
		$this->setPhpName('Session');
		$this->setClassname('Session');
		$this->setPackage('lib.model.session');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('SESS_ID', 'SessId', 'VARCHAR', true, 128, null);
		$this->addColumn('SESS_DATA', 'SessData', 'LONGVARCHAR', false, null, null);
		$this->addColumn('SESS_TIME', 'SessTime', 'INTEGER', false, null, null);
		$this->addColumn('SESS_USER', 'SessUser', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // SessionTableMap