<?php
namespace wcf\system\event\listener;
use wcf\system\event\IEventListener;
use wcf\system\WCF;

/**
 * Updates the stored username on user rename.
 * 
 * @author	Alexander Ebert
 * @copyright	2001-2014 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf.conversation
 * @subpackage	system.event.listener
 * @category	Community Framework
 */
class ConversationUserActionRenameListener implements IEventListener {
	/**
	 * @see	\wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		$objects = $eventObj->getObjects();
		$userID = $objects[0]->userID;
		
		$parameters = $eventObj->getParameters();
		$username = $parameters['data']['username'];
		
		WCF::getDB()->beginTransaction();
		
		// conversations
		$sql = "UPDATE	wcf".WCF_N."_conversation
			SET	username = ?
			WHERE	userID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($username, $userID));
		
		$sql = "UPDATE	wcf".WCF_N."_conversation
			SET	lastPoster = ?
			WHERE	lastPosterID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($username, $userID));
		
		// conversation messages
		$sql = "UPDATE	wcf".WCF_N."_conversation_message
			SET	username = ?
			WHERE	userID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($username, $userID));
		
		WCF::getDB()->commitTransaction();
	}
}
