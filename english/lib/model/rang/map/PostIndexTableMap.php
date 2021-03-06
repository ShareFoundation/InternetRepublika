<?php


/**
 * This class defines the structure of the 'post_index' table.
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
 * @package    lib.model.rang.map
 */
class PostIndexTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.rang.map.PostIndexTableMap';

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
		$this->setName('post_index');
		$this->setPhpName('PostIndex');
		$this->setClassname('PostIndex');
		$this->setPackage('lib.model.rang');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('POST_ID', 'PostId', 'INTEGER', 'post', 'ID', true, null, null);
		$this->addColumn('DAILY', 'Daily', 'FLOAT', true, null, 0);
		$this->addColumn('WEEKLY', 'Weekly', 'FLOAT', true, null, 0);
		$this->addColumn('TOTAL', 'Total', 'FLOAT', true, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Post', 'Post', RelationMap::MANY_TO_ONE, array('post_id' => 'id', ), 'CASCADE', 'CASCADE');
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

} // PostIndexTableMap
