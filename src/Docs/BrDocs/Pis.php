<?php

namespace Nscps\Ds\Docs\BrDocs;

class Pis
{
	
	const PATTERN = '/^[0-9]{3}\.[0-9]{5}\.[0-9]{2}\-[0-9]{1}$/';
	const RAW_PATTERN = '/^[0-9]{11}$/';

    /**
     * @var string
     */
	private string $pis = '';

    /**
     * Pis constructor.
     * @param string $pis
     */
	public function __construct(string $pis)
	{
        $this->validate($pis);

		$this->pis = $pis;
	}

    /**
     * @return string
     */
	public function __toString()
    {
        return $this->getPis();
    }

    /**
     * @return string
     */
    public function getPis(): string
	{
	    $raw = $this->getRaw();

        return sprintf(
            '%s.%s.%s-%s',
            substr($raw, 0, 3),
            substr($raw,3, 5),
            substr($raw,8, 2),
            substr($raw,10, 1),
        );
	}

    /**
     * @return string
     */
	public function getRaw(): string
	{
        return preg_replace("/[^0-9]/", "", $this->pis);
	}

    /**
     * @param string $pis
     * @return int
     */
	private function getC1(string $pis): int
	{
		$c1 = 0;
		
        for ($i = 0, $j = 3; $i < 2; $i++, $j--) {
            $c1 += $pis[$i] * $j;
        }
		
        for ($j = 9; $i < 10; $i++, $j--) {
            $c1 += $pis[$i] * $j;
        }
		
		return $c1;
	}

    /**
     * @param int $c1
     * @return int
     */
	private function getDigit(int $c1): int
	{
		return $c1 % 11 < 2 ? 0 : 11 - ($c1 % 11);
	}

    /**
     * @param string $pis
     */
	private function validate(string $pis)
	{
		if (
			!preg_match(self::RAW_PATTERN, $pis) &&
			!preg_match(self::PATTERN, $pis)
		) {
			throw new \InvalidArgumentException('The PIS must contain 11 digits or match the following pattern: "999.99999.99-9".');
		}
		
		// Remove everything that is not a digit
        $pis = preg_replace("/[^0-9]/", "", $pis);
		
		// 000.00000.00-0 is invalid.
		if (str_repeat('0', 11) === $pis) {
			throw new \InvalidArgumentException('Invalid PIS.');
		}
		
		// Validate D1
        $c1 = $this->getC1($pis);
		$d1 = $this->getDigit($c1);
		if ($d1 != $pis[10]) {
			throw new \InvalidArgumentException('Invalid PIS.');
		}
	}
	
}