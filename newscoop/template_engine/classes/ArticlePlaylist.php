<?php

require_once('ListObject.php');
require_once($GLOBALS['g_campsiteDir'] . '/classes/CampCache.php');


/**
 * ArticlesList class
 *
 */
class ArticlePlaylist extends ListObject
{
    private static $s_parameters = array
    (
    	'id' => array( 'field' => 'id_playlist', 'type'=>'integer'),
		'name' => array( 'field' => 'name', 'type'=>'string' )
    );
    private static $s_orderFields = array();
    private static $s_articleTypes = null;
    private static $s_dynamicFields = null;

    const CONSTRAINT_ATTRIBUTE_NAME = 1;
    const CONSTRAINT_DYNAMIC_FIELD = 4;
    const CONSTRAINT_OPERATOR = 2;
    const CONSTRAINT_VALUE = 3;

    private $m_ignoreIssue = false;
    private $m_ignoreSection = false;


    /**
	 * Creates the list of objects. Sets the parameter $p_hasNextElements to
	 * true if this list is limited and elements still exist in the original
	 * list (from which this was truncated) after the last element of this
	 * list.
	 *
	 * @param int $p_start
	 * @param int $p_limit
	 * @param array $p_parameters
	 * @param int &$p_count
	 * @return array
	 */
	protected function CreateList($p_start = 0, $p_limit = 0, array $p_parameters, &$p_count)
	{
	    $doctrine = Zend_Registry::get('doctrine');
        if (!$doctrine) {
            return false;
        }

	    $repo = $doctrine->getEntityManager()->getRepository('Newscoop\Entity\Playlist');
        /* @var $repo \Newscoop\Entity\Repository\PlaylistRepository */

        // get playlist
        if (isset($p_parameters['name']) && trim($p_parameters['name'])) {
            $playlist = $repo->findBy(array( "name" => $p_parameters['name'] ));
        }
        if (isset($p_parameters['id']) && trim($p_parameters['id'])!="") {
            $playlist = $repo->find($p_parameters['id']);
        }
        if (!($playlist instanceof \Newscoop\Entity\Playlist)) {
            return false;
        }

        $langRepo = $doctrine->getEntityManager()->getRepository('Newscoop\Entity\Language');
        /* @var $langRepo \Newscoop\Entity\Repository\LanguageRepository */
        $lang = $langRepo->find($p_parameters['language']);

        return $repo->articles($playlist, $lang, true);
	}


	/**
	 * Processes list constraints passed in an array.
	 *
	 * @param array $p_constraints
	 * @return array
	 */
	protected function ProcessConstraints(array $p_constraints)
	{
	    return $p_constraints;
	}


	/**
	 * Processes order constraints passed in an array.
	 *
	 * @param array $p_order
	 * @return array
	 */
	protected function ProcessOrder(array $p_order)
	{
	    return $p_order;
	}


	/**
	 * Processes the input parameters passed in an array; drops the invalid
	 * parameters and parameters with invalid values. Returns an array of
	 * valid parameters.
	 *
	 * @param array $p_parameters
	 * @return array
	 */
	protected function ProcessParameters(array $p_parameters)
	{
		return $p_parameters;
	}
}

