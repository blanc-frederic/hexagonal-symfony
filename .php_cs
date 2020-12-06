<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('bin')
    ->exclude('config')
    ->exclude('node_modules')
    ->exclude('public')
    ->exclude('var')
    ->exclude('vendor')
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setRules([
        // custom
        'not_operator_with_successor_space' => true,
        'declare_strict_types' => true,

        // @PSR12
        '@PSR2' => true,
        'binary_operator_spaces' => true,
        'blank_line_after_opening_tag' => true,
        'braces' => [
            'allow_single_line_closure' => false,
            'position_after_anonymous_constructs' => 'same',
            'position_after_control_structures' => 'same',
            'position_after_functions_and_oop_constructs' => 'next',
        ],
        'concat_space' => ['spacing' => 'one'],
        'declare_equal_normalize' => [
            'space' => 'none'
        ],
        'lowercase_cast' => true,
        'new_with_braces' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_extra_blank_lines' => false,
        'no_leading_import_slash' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_before_comma_in_array' => true,
        'ordered_class_elements' => [
            'order' => ['use_trait']
        ],
        'ordered_imports' => [
            'importsOrder' => ['class', 'const', 'function']
        ],
        'return_type_declaration' => true,
        'short_scalar_cast' => true,
        'single_import_per_statement' => false,
        'space_after_semicolon' => [
            'remove_in_empty_for_expressions' => true,
        ],
        'ternary_operator_spaces' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => [
            'elements' => ['const', 'method', 'property']
        ],
        'whitespace_after_comma_in_array' => true,
    ])
;