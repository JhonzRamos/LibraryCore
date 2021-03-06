<tr>

    <td>
        <select name="f_type[]" class="form-control type" required="required">
            @foreach($fieldTypes as $key => $option)
                <option value="{{ $key }}"
                        @if($key == old('f_type.'.$index)) selected @endif>{{ $option }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="text" name="f_title[]" value="{{ old('f_title.'.$index) }}" class="form-control title field_title"
               required="required" placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-field_db_name') }}">

        <!-- File size limit -->
        <label class="size">{{ trans('quickadmin::templates.templates-menu_field_line-size_limit') }}</label>
        <input type="text" name="f_size[]" value="{{ old('f_size.'.$index, '2') }}" class="form-control size"
               placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-size_limit_placeholder') }}" style="display: none;">
        <!-- /File size limit -->

        <!-- File dimensions limit -->
        <label class="dimensions">{{ trans('quickadmin::templates.templates-menu_field_line-maximum_width') }}</label>
        <input type="text" name="f_dimension_w[]" value="{{ old('f_dimension_w.'.$index, '4096') }}"
               class="form-control dimensions"
               placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-maximum_width_placeholder') }}" style="display: none;">
        <label class="dimensions">{{ trans('quickadmin::templates.templates-menu_field_line-maximum_height') }}</label>
        <input type="text" name="f_dimension_h[]" value="{{ old('f_dimension_h.'.$index, '4096') }}"
               class="form-control dimensions"
               placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-maximum_height_placeholder') }}" style="display: none;">
        <!-- /File dimensions limit -->

        <!-- Value for radio button -->
        <input type="text" name="f_value[]" value="{{ old('f_value.'.$index) }}" class="form-control value"
               placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-value') }}" style="display: none;">
        <!-- /Value for radio button -->

        <!-- Default value of a checkbox -->
        <select name="f_default[]" class="form-control default_c" style="display: none;">
            @foreach($defaultValuesCbox as $key => $option)
                <option value="{{ $key }}"
                        @if($key == old('f_default.'.$index)) selected @endif>{{ $option }}</option>
            @endforeach
        </select>
        <!-- /Default value of a checkbox -->

        <!-- Use tinymce on textarea field -->
        <select name="f_texteditor[]" class="form-control texteditor" style="display: none;">
            <option value="0"
                    @if($key == old('f_texteditor.'.$index)) selected @endif>Don't Use TinyMCE
            </option>
            <option value="1"
                    @if($key == old('f_texteditor.'.$index)) selected @endif>Use TinyMCE
            </option>
        </select>
        <!-- /Use ckeditor on textarea field -->

        <!-- Select for relationship -->
        <select name="f_relationship[]" class="form-control relationship" style="display: none;">
            <option value="">{{ trans('quickadmin::templates.templates-menu_field_line-select_relationship') }}</option>
            @foreach($menusSelect as $key => $option)
                <option value="{{ $key }}"
                        @if($key == old('f_relationship.'.$index)) selected @endif>{{ $option }}</option>
            @endforeach
        </select>
        <!-- /Select for relationship -->
        <div class="relationship-holder"></div>

        <!-- ENUM values -->
        <label class="enum">{{ trans('quickadmin::templates.templates-menu_field_line-enum_values') }}</label>
        <input type="text" name="f_enum[]" value="{{ old('f_enum.'.$index) }}" class="form-control enum tags"
               placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-enum_values_placeholder') }}" style="display: none;">
        <!-- /ENUM values -->
        {{--<div class="form-group field-options"><label class="false-label">Options</label><div class="sortable-options-wrap"><ol class="sortable-options ui-sortable"><li class="ui-sortable-handle" style="position: relative; left: 0px; top: 0px;"><input type="radio" class="option-selected" value="false" name="radio-group-1524635884066-option" placeholder=""><input type="text" class="option-label" value="Option 1" name="radio-group-1524635884066-option" placeholder="Label"><input type="text" class="option-value" value="option-1" name="radio-group-1524635884066-option" placeholder="Value"><a class="remove btn" title="Remove Element">�</a></li><li class="ui-sortable-handle" style="position: relative; left: 0px; top: 0px;"><input type="radio" class="option-selected" value="false" name="radio-group-1524635884066-option" placeholder=""><input type="text" class="option-label" value="Option 2" name="radio-group-1524635884066-option" placeholder="Label"><input type="text" class="option-value" value="option-2" name="radio-group-1524635884066-option" placeholder="Value"><a class="remove btn" title="Remove Element">�</a></li><li class="ui-sortable-handle"><input type="radio" class="option-selected" value="false" name="radio-group-1524635884066-option" placeholder=""><input type="text" class="option-label" value="Option 3" name="radio-group-1524635884066-option" placeholder="Label"><input type="text" class="option-value" value="option-3" name="radio-group-1524635884066-option" placeholder="Value"><a class="remove btn" title="Remove Element">�</a></li></ol><div class="option-actions"><a class="add add-opt">Add Option +</a></div></div></div>--}}
    </td>
    <td>
        <input type="text" name="f_label[]" value="{{ old('f_label.'.$index) }}" class="form-control visual_title"
               required="required" placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-field_visual_title_placeholder') }}">
        <input type="text" name="f_helper[]" value="{{ old('f_helper.'.$index) }}" class="form-control"
               placeholder="{{ trans('quickadmin::templates.templates-menu_field_line-comment_below_placeholder') }}">
    </td>
    <td>
        <!-- Select for render -->
        <select name="f_render[]" class="form-control render" required="required" disabled>
            @foreach($renderTypes as $key => $option)
                <option value="{{ $key }}"
                        @if($key == old('f_render.'.$index)) selected @endif>{{ $option }}</option>
            @endforeach
        </select>
        <input type="text" name="f_custom[]" value="" class="form-control custom" style="display: none;"
               placeholder="Custom Code">
    </td>
    <td>
        <input type="hidden" name="f_list[]" class="list_hid">
        <input type="checkbox" value="1" checked class="list2">
    </td>
    <td>
        <input type="hidden" name="f_add[]" class="add_hid">
        <input type="checkbox" value="1" checked class="add2">
    </td>
    <td>
        <input type="hidden" name="f_show[]" class="show_hid">
        <input type="checkbox" value="1" checked  class="show2">
    </td>
    <td>
        <input type="hidden" name="f_edit[]" class="edit_hid">
        <input type="checkbox" value="1"  checked class="edit2">
    </td>
    <td>
        <input type="hidden" name="f_search[]"  class="search_hid">
        <input type="checkbox" value="1" checked class="search2">
    </td>

    <td>
        <select name="f_validation[]" class="form-control" required="required">
            @foreach($fieldValidation as $key => $option)
                <option value="{{ $key }}"
                        @if($key == old('f_validation.'.$index)) selected @endif>{{ $option }}</option>
            @endforeach
        </select>
    </td>
    <td><a href="#" class="rem btn btn-danger"><i class="fa fa-trash"></i></a></td>
</tr>
