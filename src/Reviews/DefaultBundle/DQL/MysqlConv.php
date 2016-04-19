<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/13/2016
 * Time: 7:44 PM
 */

namespace Reviews\DefaultBundle\DQL;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 * MysqlConvFunction ::= "CONV(StringPrimary,16,10,4096) = 4096"
 *      returns CONV(StringPrimary,16,10) & 4096 = 4096
 */
class MysqlConv extends FunctionNode
{
    public $stringFirst;
    public $stringSecond;
    public $stringThird;
    public $stringFourth;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->stringFirst = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->stringSecond = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->stringThird = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->stringFourth = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'CONV(' .
        $this->stringFirst->dispatch($sqlWalker) .
        ',' . $this->stringSecond->dispatch($sqlWalker) . ',' . $this->stringThird->dispatch($sqlWalker) . ') & ' . $this->stringFourth->dispatch($sqlWalker);
    }
}