<?php

namespace JsonSerializer;

/**
 * JsonSerializableObject
 * 
 * @package denisyfrolov/json-serializer
 * @author Denis Frolov <denisyfrolov@hotmail.com>
 */
class JsonSerializableObject
{
    /**
     * Serialize self to Json
     *
     * @return string
     */
    final public function jsonSerialize(): string
    {
        return json_encode(
            $this->arraySerialize()
        );
    }

    /**
     * Serialize self to Array
     *
     * @return array
     */
    final private function arraySerialize(): array
    {
        $reflect = new \ReflectionClass($this);

        if (!preg_match('#@JsonSerializable#', $reflect->getDocComment()))
        {
            throw new \Exception('Class ' . $reflect->getName() . ' is not marked as serializable');
        }

        $JsonProperties = array();

        foreach ($reflect->getProperties() as $property)
        {
            if (!preg_match('#@JsonPropertyNonSerializable#', $property->getDocComment()) && $reflect->hasMethod('get' . $property->name) && $reflect->getMethod('get' . $property->name)->isPublic())
            {
                if (preg_match('#@JsonPropertyName ([A-z0-9_]*)#', $property->getDocComment(), $matches))
                {
                    $JsonPropertyName = $matches[1];
                } else
                {
                    $JsonPropertyName = $property->name;
                }

                $JsonProperties[$JsonPropertyName] = $reflect->getMethod('get' . $property->name)->Invoke($this);

                if (is_object($JsonProperties[$JsonPropertyName]))
                {
                    $JsonProperties[$JsonPropertyName] = $JsonProperties[$JsonPropertyName]->arraySerialize();
                } elseif (is_array($JsonProperties[$JsonPropertyName]))
                {
                    $propertiesChild = $JsonProperties[$JsonPropertyName];
                    $JsonProperties[$JsonPropertyName] = array();

                    foreach ($propertiesChild as $propertyChild)
                    {
                        if (is_object($propertyChild))
                        {
                            $JsonProperties[$JsonPropertyName][] = $propertyChild->arraySerialize();
                        } else
                        {
                            $JsonProperties[$JsonPropertyName][] = $propertyChild;
                        }
                    }
                }
            }
        }
        return $JsonProperties;
    }
}
