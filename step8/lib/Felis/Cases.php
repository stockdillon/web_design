<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 6/15/17
 * Time: 10:23 PM
 */

namespace Felis;


class Cases extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "case");
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @returns ClientCase that represents the case if successful,
     *  null otherwise.
     */

    public function get($id) {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;

            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));
        }


    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute(array($client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN)
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }



    public function getCases(){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL
SELECT clientCase.id as id, clientCase.client, userClient.name as clientName, clientCase.agent, userAgent.name as agentName, summary, status, number
FROM $this->tableName clientCase
INNER JOIN $usersTable userClient
ON clientCase.client=userClient.id
INNER JOIN $usersTable userAgent
On clientCase.agent=userAgent.id
ORDER BY status desc, number
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        //$statement->execute();

        try {
            if($statement->execute(array()
                ) === false) {
                return null;
            }

            $rows = [];
            $rows = $statement->fetchall(\PDO::FETCH_ASSOC);
            var_dump($rows);

            $cases = [];
            foreach($rows as $row){
                $cases[] = new ClientCase($row);
            }
        } catch(\PDOException $e) {
            return null;
        }
        return $cases;
    }






    public function update(ClientCase $case)
    {
        $id = ($case->getId());
        echo "id: $id <br>";

        if ($this->get($id) === null) {
            return false;
        } else {
            $clientID = $case->getClient();
            $clientName = $case->getClientName();
            $agentID = $case->getAgent();
            $agentName = $case->getAgentName();
            $number = $case->getNumber();
            $summary = $case->getSummary();
            $status = $case->getStatus();
            echo "client ID: $clientID <br>";
            echo "clientName: $clientName <br>";
            echo "agent ID: $agentID <br>";
            echo "agent name: $agentName <br>";
            echo "number: $number <br>";
            echo "summary: $summary <br>";
            echo "status: $status <br>";
            $sql = <<<SQL
UPDATE $this->tableName
SET client=?, agent=?, number=?, summary=?, status=? 
WHERE id=?
SQL;

            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);

            try {
                $ret = $statement->execute(array($clientID, $agentID, $number, $summary, $status, $id));
                return $ret;
            }
            catch (\PDOException $e) {
                echo $e;
                return false;
            }
        }
    }






































}