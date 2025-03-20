<?php

class Db extends SQLite3
{
	public function query(string $query, $params = [])
	{
    if (empty($params)) {
        return parent::query($query);
    }
    $stmt = $this->prepare($query);

    if ($stmt === false) {
        throw new Exception("Failed to prepare statement: " . $this->lastErrorMsg());
    }

    // Bind parameters
    foreach ($params as $key => $value) {
        // Assuming the keys are 1-based index for ? placeholders
        if (!$stmt->bindValue($key + 1, $value)) {
            throw new Exception("Failed to bind parameter: " . $this->lastErrorMsg());
        }
    }
    $result = $stmt->execute();

    if ($result === false) {
        throw new Exception("Failed to execute statement: " . $this->lastErrorMsg());
    }
    return $result;
	}
}