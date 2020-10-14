<?php

namespace Nscps\Ds\Docs\BrDocs;

class Cpf
{

    const PATTERN = '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/';
	const RAW_PATTERN = '/^[0-9]{11}$/';

    /**
     * @var string
     */
	private string $cpf = '';

    /**
     * Cpf constructor.
     * @param string $cpf
     */
	public function __construct(string $cpf)
	{
		$this->validate($cpf);

		$this->cpf = $cpf;
	}

    /**
     * @return string
     */
	public function __toString()
    {
        return $this->getCpf();
    }

    /**
     * @return string
     */
	public function getCpf(): string
	{
	    $raw = $this->getRaw();

        return sprintf(
            '%s.%s.%s-%s',
            substr($raw, 0, 3),
            substr($raw, 3, 3),
            substr($raw, 6, 3),
            substr($raw, 9, 2)
        );
	}

    /**
     * @return string
     */
	public function getRaw(): string
	{
		return preg_replace("/[^0-9]/", "", $this->cpf);
	}

    /**
     * @param string $cpf
     * @return int
     */
	private function getC1(string $cpf): int
	{
		$c1 = 0;
		
		$i = 0;
		$j = 10;
		while ($i <= 8) {
			$c1 += $cpf[$i] * $j;
			$i++;
			$j--;
		}
		
		return $c1;
	}

    /**
     * @param string $cpf
     * @return int
     */
	private function getC2(string $cpf): int
	{
		$c2 = 0;
		
		$i = 0;
		$j = 11;
		while ($i <= 8) {
			$c2 += $cpf[$i] * $j;
			$i++;
			$j--;
		}
		
        $c2 += $cpf[$i] * $j;
		
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
     * @param string $cpf
     */
	private function validate(string $cpf)
	{
		if (
			!preg_match(self::RAW_PATTERN, $cpf) &&
			!preg_match(self::PATTERN, $cpf)
		) {
			throw new \InvalidArgumentException('The CPF must contains 11 digits or match the following pattern: "999.999.999-99".');
		}
		
		// Remove everything that is not a digit
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
		
		// 000.000.000-00, 111.111.111-11, ..., 999.999.999-99 are invalid.
		for ($i = 0; $i <= 9; $i++) {
			if (str_repeat((string) $i, 11) === $cpf) {
				throw new \InvalidArgumentException('Invalid CPF.');
			}
		}
		
		// Validate D1
        $c1 = $this->getC1($cpf);
		$d1 = $this->getDigit($c1);
		if ($d1 != $cpf[9]) {
			throw new \InvalidArgumentException('Invalid CPF.');
		}
		
		// Validate D2
        $c2 = $this->getC2($cpf);
		$d2 = $this->getDigit($c2);
		if ($d2 != $cpf[10]) {
			throw new \InvalidArgumentException('Invalid CPF.');
		}
	}
	
}