<?php

namespace Nscps\Ds\Docs\BrDocs;

class Cnpj
{
	
	const PATTERN = '/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\/[0-9]{4}-[0-9]{2}$/';
	const RAW_PATTERN = '/^[0-9]{14}$/';

    /**
     * @var string
     */
	private string $cnpj = '';

    /**
     * Cnpj constructor.
     * @param string $cnpj
     */
	public function __construct(string $cnpj)
	{
        $this->validate($cnpj);

		$this->cnpj = $cnpj;
	}

    /**
     * @return string
     */
	public function __toString()
    {
        return $this->getCnpj();
    }

    /**
     * @return string
     */
    public function getCnpj(): string
	{
	    $raw = $this->getRaw();

		return sprintf(
            '%s.%s.%s/%s-%s',
            substr($raw, 0, 2),
            substr($raw, 2, 3),
            substr($raw, 5, 3),
            substr($raw, 8, 4),
            substr($raw, 12, 2)
        );
	}

    /**
     * @return string
     */
	public function getRaw(): string
	{
		return preg_replace("/[^0-9]/", "", $this->cnpj);
	}

    /**
     * @param string $cnpj
     * @return int
     */
	private function getC1(string $cnpj): int
	{
		$c1 = 0;
		
		$i = 0;
		$m = 5;
		while ($i < 4) {
			$c1 += $cnpj[$i] * $m;
			$i++;
			$m--;
		}

		$m = 9;
		while ($i < 12) {
			$c1 += $cnpj[$i] * $m;
			$i++;
			$m--;
		}
		
		return $c1;
	}

    /**
     * @param string $cnpj
     * @return int
     */
	private function getC2(string $cnpj): int
	{
		$c2 = 0;

		$i = 0;
		$m = 6;
		while ($i < 5) {
			$c2 += $cnpj[$i] * $m;
			$i++;
			$m--;
		}

		$m = 9;
		while ($i < 13) {
			$c2 += $cnpj[$i] * $m;
			$i++;
			$m--;
		}
		
		return $c2;
	}

    /**
     * @param int $c
     * @return int
     */
	private function getDigit(int $c): int
	{
		return $c % 11 < 2 ? 0 : 11 - ($c % 11);
	}

    /**
     * @param string $cnpj
     */
	private function validate(string $cnpj)
	{
		if (
			!preg_match(self::RAW_PATTERN, $cnpj) &&
			!preg_match(self::PATTERN, $cnpj)
		) {
			throw new \InvalidArgumentException('The CNPJ must contain 14 digits or match the following pattern: "99.999.999/9999-99".');
		}
		
		// Remove everything that is not a digit
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
		
		// 00.000.000/0000-00 is invalid.
        if (str_repeat('0', 14) === $cnpj) {
            throw new \InvalidArgumentException('Invalid CNPJ.');
        }
		
		// Validate D1
        $c1 = $this->getC1($cnpj);
		$d1 = $this->getDigit($c1);
		if ($d1 != $cnpj[12]) {
			throw new \InvalidArgumentException('Invalid CNPJ.');
		}
		
		// Validate D2
        $c2 = $this->getC2($cnpj);
        $d2 = $this->getDigit($c2);
		if ($d2 != $cnpj[13]) {
			throw new \InvalidArgumentException('Invalid CNPJ.');
		}
	}
	
}