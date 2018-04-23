<?php
namespace Laraveldaily\Quickadmin\Fields;

class FieldsDescriber
{
    /**
     * Default QuickAdmin field types
     * @return array
     */
    public static function types()
    {
        return [
            'text'         => 'Text field',
            'email'        => 'Email field',
            'number'       => 'Number field', ///additional
            'float'        => 'Float field', ///additional
            'location'     => 'Location', ///additional
            'color'        => 'Color', ///additional
            'time'         => 'Time', ///additional
            'toggle'       => 'Toggle', ///additional
            'relationship_many' => 'Belongs to Many', ///additional
            'textarea'     => 'Text Area',
            'radio'        => 'Radio',
            'checkbox'     => 'Checkbox',
            'date'         => 'Date Picker',
            'datetime'     => 'Date and Time picker',
            'relationship' => 'Relationship',
            'file'         => 'File Upload',
            'photo'        => 'Photo Upload',
            'password'     => 'Password Field (hashed)',
            'money'        => 'Money',
            'enum'         => 'ENUM',
        ];
    }

    /**
     * Default QuickAdmin field validation types
     * @return array
     */
    public static function validation()
    {
        return [
            'optional'        => trans('quickadmin::strings.optional'),
            'required'        => trans('quickadmin::strings.required'),
            'required|unique' => trans('quickadmin::strings.required_unique')
        ];
    }

    /**
     * Set fields to be nullable by default if validation is not in this array
     * @return array
     */
    public static function nullables()
    {
        return [
            'optional',
        ];
    }

    /**
     * Default QuickAdmin field types for migration
     * @return array
     */
    public static function migration()
    {
        return [
            'text'         => 'string("$FIELDNAME$")',
            'email'        => 'string("$FIELDNAME$")',
            'number'       => 'integer("$FIELDNAME$")', ///additional
            'float'        => 'float("$FIELDNAME$", 7, 2)', ///additional
            'color'        => 'string("$FIELDNAME$")', ///additional
            'time'         => 'text("$FIELDNAME$")', ///additional
            'toggle'       => 'string("$FIELDNAME$")', ///additional
            'textarea'     => 'text("$FIELDNAME$")',
            'location'     => 'text("$FIELDNAME$")',
            'radio'        => 'string("$FIELDNAME$")',
            'checkbox'     => 'tinyInteger("$FIELDNAME$")->default($STATE$)',
            'date'         => 'date("$FIELDNAME$")',
            'datetime'     => 'dateTime("$FIELDNAME$")',
            'relationship' => 'integer("$RELATIONSHIP$_id")->references("id")->on("$RELATIONSHIP$")',
            'relationship_many' => 'integer("$RELATIONSHIP$_id")->references("id")->on("$RELATIONSHIP$")',
            'file'         => 'string("$FIELDNAME$")',
            'photo'        => 'string("$FIELDNAME$")',
            'password'     => 'string("$FIELDNAME$")',
            'money'        => 'decimal("$FIELDNAME$", 15, 2)',
            'enum'         => 'enum("$FIELDNAME$", [$VALUES$])',
        ];
    }

    /**
     * Default QuickAdmin state for checkbox
     * @return array
     */
    public static function default_cbox()
    {
        return [
            'false' => trans('quickadmin::strings.default_unchecked'),
            'true'  => trans('quickadmin::strings.default_checked'),
        ];
    }

    public static function render() //render type
    {
        return [
            'default'      => 'Default',
            'date'         => 'Date',
            'checkbox'     => 'Checkbox', ///additional
            'link'         => 'Link',
            'radio'        => 'Radio',
            'photo'        => 'Photo field',
            'money'        => 'Money',
            'status'         => 'Binary',
            'custom'         => 'Custom',
        ];
    }
}