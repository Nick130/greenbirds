<?php

/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['accordion'] = array(
	'tag_close' => 'true',
	'params' => array(
			'titlecolor' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Title Text Color', 'my_framework')
			),
			'titlebackground' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Title Background Color', 'my_framework')
			),
			'signcolor' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Sign Color', 'my_framework')
			),
			'signbackground' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Sign Background Color', 'my_framework')
			),
			'contentcolor' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Content Text Color', 'my_framework')
			),
			'contentbackground' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Content Background Color', 'my_framework')
			)
	),
	'shortcode' => 'accordion',
	'popup_title' => __('Accordion', 'my_framework'),
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'type' => 'text',
				'def' => 'your title',
                'label' => __('Title', 'my_framework')
            ),
			'active' => array(
				'type' => 'select',
				'def' => '',
				'label' => __('Item Status', 'my_framework'),
				'options' => array(
					'' => 'Close',
					'active' => 'Open'
				)
			),
			'content' => array(
				'type' => 'textarea',
				'def' => 'your content',
				'label' => __('Content', 'my_framework')
			)
        ),
        'shortcode' => 'ac-item',
        'clone_button' => __('Add Accordion', 'my_framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['buttons'] = array(
	'tag_close' => 'false',
	'params' => array(
		'text' => array(
			'type' => 'text',
			'def' => 'READ MORE',
			'label' => __('Button Text', 'my_framework')
		),
		'href' => array(
			'type' => 'text',
			'def' => '#',
			'label' => __('Destination URL', 'my_framework')
		),
		'size' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'small' => 'Small',
				'' => 'Normal',
				'larg' => 'Larg',
				'xlarg' => 'XLarg'
			)
		),
		'class' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'reverse' => 'Reverse'
			)
		)
	),
	'shortcode' => 'buttons',
	'popup_title' => __('Button', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Client Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['client'] = array(
	'tag_close' => 'true',
	'params' => array(
		'class' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'dark' => 'Dark'
			)
		),
		'showcarousel' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Carousel', 'my_framework'),
			'options' => array(
				'off' => 'Disable',
				'' => 'Enable'
			)
		),
		'navigation' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Navigation', 'my_framework'),
			'options' => array(
				'' => 'None',
				'direction' => 'Direction',
				'pagination' => 'Pagination'
			)
		),
		'visiblenumber' => array(
			'type' => 'text',
			'def' => '5',
			'label' => __('Number of Visible Images', 'my_framework')
		),
		'showdivider' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Divider', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		)
	),
	'shortcode' => 'client',
	'popup_title' => __('Client', 'my_framework'),
    'child_shortcode' => array(
        'params' => array(
            'href' => array(
                'type' => 'text',
				'def' => '#',
                'label' => __('Destination URL', 'my_framework')
            ),
            'image' => array(
                'type' => 'image',
				'def' => '',
                'label' => __('Image ID', 'my_framework')
            )
        ),
        'shortcode' => 'cl-item',
        'clone_button' => __('Add Client', 'my_framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Column Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['column'] = array(
	'tag_close' => 'true',
	'params' => array(
		'size' => array(
			'type' => 'select',
			'def' => '1/1',
			'label' => __('Column', 'my_framework'),
			'options' => array(
				'1/1' => '1/1',
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4',
				'5/12' => '5/12',
				'1/6' => '1/6',
				'7/12' => '7/12',
				'2/3' => '2/3',
				'3/4' => '3/4',
				'5/6' => '5/6'
			)
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'column',
	'popup_title' => __('Column', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Column Percent Style Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['percent_column'] = array(
	'tag_close' => 'true',
	'params' => array(
		'width' => array(
			'type' => 'text',
			'def' => '25%',
			'label' => __('Column Width', 'my_framework')
		),
		'paddingleft' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Padding Left (in px)', 'my_framework')
		),
		'paddingright' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Padding Right (in px)', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'percent-column',
	'popup_title' => __('Percent Column', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Contact Info Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['contact_info'] = array(
	'tag_close' => 'false',
	'params' => array(
		'size' => array(
			'type' => 'select',
			'def' => '1/1',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/1' => '1/1',
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4'
			)
		),
		'style' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Style', 'my_framework'),
			'options' => array(
				'' => 'default',
				'color' => 'color'
			)
		),
		'address' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Address', 'my_framework')
		),
		'phone' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Phone', 'my_framework')
		),
		'email' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Email', 'my_framework')
		),
		'web' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Website', 'my_framework')
		)
	),
	'shortcode' => 'contact-info',
	'popup_title' => __('Contact Info', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Counter
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['counter'] = array(
	'tag_close' => 'true',
	'params' => array(
		'size' => array(
			'type' => 'select',
			'def' => '1/4',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/1' => '1/1',
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4'
			)
		),
		'start' => array(
			'type' => 'text',
			'def' => '1',
			'label' => __('Start', 'my_framework')
		),
		'end' => array(
			'type' => 'text',
			'def' => '100',
			'label' => __('End', 'my_framework')
		),
		'color' => array(
			'type' => 'color',
			'def' => '100',
			'label' => __('Number color', 'my_framework')
		),
		'speed' => array(
			'type' => 'text',
			'def' => '2000',
			'label' => __('Speed', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		),
	),
	'shortcode' => 'counter',
	'popup_title' => __('Counter', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Divider Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['divider'] = array(
	'tag_close' => 'false',
	'params' => array(
		'width' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Width (in px or %)', 'my_framework')
		),
		'class' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'right' => 'Right',
				'left' => 'Left'
			)
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Divider Color', 'my_framework')
		),
		'text' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Text', 'my_framework')
		),
		'textalign' => array(
			'type' => 'select',
			'def' => 'right',
			'label' => __('Text Align', 'my_framework'),
			'options' => array(
				'right' => 'Right',
				'left' => 'Left'
			)
		),
		'textcolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'textsize' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Text Size (in px)', 'my_framework')
		)
	),
	'shortcode' => 'divider',
	'popup_title' => __('Divider', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Dropcap Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['dropcap'] = array(
	'tag_close' => 'true',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'circle' => 'Circle',
				'hbar' => 'Horizontal Bar',
				'vbar' => 'Vertical Bar',
				'square' => 'Square'
			)
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'N',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'dropcap',
	'popup_title' => __('Dropcap', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	FAQ Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['faq'] = array(
	'tag_close' => 'true',
	'params' => array(
	),
	'shortcode' => 'faq',
	'popup_title' => __('FAQ', 'my_framework'),
    'child_shortcode' => array(
        'params' => array(
            'q' => array(
                'type' => 'text',
				'def' => '',
                'label' => __('Question', 'my_framework')
            ),
			'content' => array(
				'type' => 'textarea',
				'def' => 'your answer',
				'label' => __('Answer', 'my_framework')
			)
        ),
        'shortcode' => 'fa-item',
        'clone_button' => __('Add Question', 'my_framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Frame Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['frame'] = array(
	'tag_close' => 'false',
	'params' => array(
		'image' => array(
			'type' => 'image',
			'def' => '',
			'label' => __('Image ID', 'my_framework')
		),
		'width' => array(
			'type' => 'text',
			'def' => '210',
			'label' => __('Width of Slider', 'my_framework')
		),
		'height' => array(
			'type' => 'text',
			'def' => '120',
			'label' => __('Height of slider', 'my_framework')
		),
		'align' => array(
			'type' => 'select',
			'def' => 'left',
			'label' => __('Align', 'my_framework'),
			'options' => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			)
		),
		'showlightbox' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Lightbox', 'my_framework'),
			'options' => array(
				'off' => 'Disable',
				'' => 'Enable',
			)
		),
		'linktype' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type of Link', 'my_framework'),
			'options' => array(
				'' => 'Zoom',
				'link' => 'Link',
				'picture' => 'Picture',
				'video' => 'Video'
			)
		),
		'href' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Destination URL', 'my_framework')
		),
		'showborder' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Border', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		' title' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Title', 'my_framework')
		)
	),
	'shortcode' => 'frame',
	'popup_title' => __('Frame', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	H1 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['h1'] = array(
	'tag_close' => 'true',
	'params' => array(
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'subtitle' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Sub Title', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your title',
			'label' => __('Title', 'my_framework')
		)
	),
	'shortcode' => 'h1',
	'popup_title' => __('H1', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	H2 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['h2'] = array(
	'tag_close' => 'true',
	'params' => array(
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'subtitle' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Sub Title', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your title',
			'label' => __('Title', 'my_framework')
		)
	),
	'shortcode' => 'h2',
	'popup_title' => __('H2', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	H3 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['h3'] = array(
	'tag_close' => 'true',
	'params' => array(
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'subtitle' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Sub Title', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your title',
			'label' => __('Title', 'my_framework')
		)
	),
	'shortcode' => 'h3',
	'popup_title' => __('H3', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	H4 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['h4'] = array(
	'tag_close' => 'true',
	'params' => array(
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'subtitle' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Sub Title', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your title',
			'label' => __('Title', 'my_framework')
		)
	),
	'shortcode' => 'h4',
	'popup_title' => __('H4', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	H5 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['h5'] = array(
	'tag_close' => 'true',
	'params' => array(
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'subtitle' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Sub Title', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your title',
			'label' => __('Title', 'my_framework')
		)
	),
	'shortcode' => 'h5',
	'popup_title' => __('H5', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	H6 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['h6'] = array(
	'tag_close' => 'true',
	'params' => array(
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'subtitle' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Sub Title', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your title',
			'label' => __('Title', 'my_framework')
		)
	),
	'shortcode' => 'h6',
	'popup_title' => __('H6', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Highlight Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['highlight'] = array(
	'tag_close' => 'true',
	'params' => array(
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'highlight',
	'popup_title' => __('Highlight', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	List Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['list'] = array(
	'tag_close' => 'true',
	'params' => array(
		'icon' => array(
			'type' => 'icon',
			'def' => 'icon-checkmark2',
			'label' => __('Icon', 'my_framework')
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
	),
	'shortcode' => 'list',
	'popup_title' => __('List', 'my_framework'),
    'child_shortcode' => array(
        'params' => array(
			'content' => array(
				'type' => 'textarea',
				'def' => 'your content',
				'label' => __('Content', 'my_framework')
			)
        ),
        'shortcode' => 'li',
        'clone_button' => __('Add List', 'my_framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Message Box Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['message_box'] = array(
	'tag_close' => 'true',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'def' => 'red',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'red' => 'Red',
				'yellow' => 'Yellow',
				'blue' => 'Blue',
				'green' => 'Green'
			)
		),
		'class' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'' => 'Big Icon',
				'small-icon' => 'Small Icon',
				'no-icon' => 'Without Icon'
			)
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'message-box',
	'popup_title' => __('Message Box', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Personnel Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['personnel'] = array(
	'tag_close' => 'true',
	'params' => array(
		'name' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Name', 'my_framework')
		),
		'post' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Position', 'my_framework')
		),
		'image' => array(
			'type' => 'image',
			'def' => '',
			'label' => __('Image ID', 'my_framework')
		),
		'size' => array(
			'type' => 'select',
			'def' => '1/3',
			'label' => __('Column', 'my_framework'),
			'options' => array(
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4',
				'1/6' => '1/6'
			)
		),
		'class' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'' => 'Light',
				'dark' => 'Dark'
			)
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'personnel',
	'popup_title' => __('Personnel', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['portfolio'] = array(
	'tag_close' => 'false',
	'params' => array(
		'number' => array(
			'type' => 'text',
			'def' => '3',
			'label' => __('Number of Items', 'my_framework')
		),
		'size' => array(
			'type' => 'select',
			'def' => '1/3',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/1' => '1/1',
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4'
			)
		),
		'column' => array(
			'type' => 'select',
			'def' => '3',
			'label' => __('Column', 'my_framework'),
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4'
			)
		),
		'category' => array(
			'type' => 'portcat',
			'def' => '',
			'label' => __('Category', 'my_framework'),
			'options' => array(
				'' => 'all'
			)
		),
		'showcategory' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Category', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'showfilter' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Filter', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'titlelength' => array(
			'type' => 'text',
			'def' => '30',
			'label' => __('Length of Title', 'my_framework')
		),
		'excerptlength' => array(
			'type' => 'text',
			'def' => '0',
			'label' => __('Length of Excerpt', 'my_framework')
		),
		'textalign' => array(
			'type' => 'select',
			'def' => 'center',
			'label' => __('Text Align', 'my_framework'),
			'options' => array(
				'center' => 'center',
				'left' => 'left',
				'right' => 'right'
			)
		),
		'showloadmore' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Loadmore Button', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		/*'singlemode' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Single-mode Style', 'my_framework'),
			'options' => array(
				'' => 'Normal',
				'lightbox' => 'Lightbox',
				'inline' => 'Inline',
				'outline' => 'Outline'
			)
		),*/
		'counter' => array(
			'type' => 'text',
			'def' => '1',
			'label' => __('Counter', 'my_framework')
		)
	),
	'shortcode' => 'portfolio',
	'popup_title' => __('Portfolio', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Post Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['post'] = array(
	'tag_close' => 'false',
	'params' => array(
		'number' => array(
			'type' => 'text',
			'def' => '3',
			'label' => __('Number of Items', 'my_framework')
		),
		'size' => array(
			'type' => 'select',
			'def' => '1/3',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4'
			)
		),
		'column' => array(
			'type' => 'select',
			'def' => '3',
			'label' => __('Column', 'my_framework'),
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4'
			)
		),
		'category' => array(
			'type' => 'postcat',
			'def' => '',
			'label' => __('Category', 'my_framework'),
			'options' => array(
				'' => 'all'
			)
		),
		'titlelength' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Length of Tile', 'my_framework')
		),
		'excerptlength' => array(
			'type' => 'text',
			'def' => '40',
			'label' => __('Length of Excerpt', 'my_framework')
		),
		'showimage' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Image', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'showdate' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Date', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'showbutton' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Button', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'showloadmore' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Loadmore Button', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'counter' => array(
			'type' => 'text',
			'def' => '1',
			'label' => __('Counter', 'my_framework')
		)
	),
	'shortcode' => 'post',
	'popup_title' => __('Post', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Price Table Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['price_table'] = array(
	'tag_close' => 'true',
	'params' => array(
	),
	'shortcode' => 'price-table',
	'popup_title' => __('Price Table', 'my_framework'),
    'child_shortcode' => array(
        'params' => array(
			'size' => array(
				'type' => 'select',
				'def' => '1/5',
				'label' => __('Size', 'my_framework'),
				'options' => array(
					'1/3' => '1/3',
					'1/4' => '1/4',
					'1/5' => '1/5',
					'1/6' => '1/6'
				)
			),
            'width' => array(
                'type' => 'text',
				'def' => '',
                'label' => __('Width of Column (in px)', 'my_framework')
            ),
            'title' => array(
                'type' => 'text',
				'def' => 'your title',
                'label' => __('Title', 'my_framework')
            ),
			'price' => array(
				'type' => 'text',
				'def' => '$99',
				'label' => __('Price', 'my_framework')
			),
			'pricetext' => array(
				'type' => 'text',
				'def' => 'per month',
				'label' => __('Price Text', 'my_framework')
			),
			'buttontext' => array(
				'type' => 'text',
				'def' => 'SUBMIT',
				'label' => __('Button Text', 'my_framework')
			),
			'href' => array(
				'type' => 'text',
				'def' => '',
				'label' => __('Destination URL', 'my_framework')
			),
			'active' => array(
				'type' => 'select',
				'def' => '',
				'label' => __('Item Status', 'my_framework'),
				'options' => array(
					'' => 'Default',
					'active' => 'Active'
				)
			),
			'content' => array(
				'type' => 'textarea',
				'def' => '[pr-text]your content[/pr-text]',
				'label' => __('Insert Cells', 'my_framework')
			)
        ),
        'shortcode' => 'pr-item',
        'clone_button' => __('Add Price Column', 'my_framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['progress_bar'] = array(
	'tag_close' => 'false',
	'params' => array(
		'title' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Title', 'my_framework')
		),
		'titlecolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Title Color', 'my_framework')
		),
		'showtitleinside' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Title Inside', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'value' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Value (in percent)', 'my_framework')
		),
		'showvalue' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Value', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'barcolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Bar Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'showradius' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Enable Radius', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		)
	),
	'shortcode' => 'progress-bar',
	'popup_title' => __('Progress Bar', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Quote Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['quote'] = array(
	'tag_close' => 'true',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'quote1' => 'quote1',
				'quote2' => 'quote2',
				'quote3' => 'quote3',
				'quote4' => 'quote4'
			)
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'width' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Width (in percent)', 'my_framework')
		),
		'align' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Align', 'my_framework'),
			'options' => array(
				'left' => 'Left',
				'' => 'Center',
				'right' => 'Right',
			)
		),
		'textshadow' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Text Shadow', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'quote',
	'popup_title' => __('Quote', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	row Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['row'] = array(
	'tag_close' => 'true',
	'params' => array(
		'textalign' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Text Align', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			)
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'image' => array(
			'type' => 'image',
			'def' => '',
			'label' => __('Background Image', 'my_framework')
		),
		'padding' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Padding <small>(top right bottom left)</small>', 'my_framework')
		),
		'margin' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Margin <small>(top right bottom left)</small>', 'my_framework')
		),
		'showparallax' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Parallax Effect', 'my_framework'),
			'options' => array(
				'off' => 'Disable',
				'' => 'Enable',
			)
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'row',
	'popup_title' => __('Row', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Servic1 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['service1'] = array(
	'tag_close' => 'true',
	'params' => array(
		'size' => array(
			'type' => 'select',
			'def' => '1/3',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4',
			)
		),
		'type' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'' => 'default',
				'reverse' => 'reverse'
			)
		),
		'title' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Title', 'my_framework')
		),
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'href' => array(
			'type' => 'text',
			'def' => '#',
			'label' => __('Destinaion URL', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'service1',
	'popup_title' => __('Service 1', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Servic2 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['service2'] = array(
	'tag_close' => 'true',
	'params' => array(
		'size' => array(
			'type' => 'select',
			'def' => '1/3',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/1' => '1/1',
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4',
				'1/6' => '1/6'
			)
		),
		'title' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Title', 'my_framework')
		),
		'type' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'' => 'type1',
				'type2' => 'type2',
				'type3' => 'type3',
				'type4' => 'type4'
			)
		),
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'href' => array(
			'type' => 'text',
			'def' => '#',
			'label' => __('Destinaion URL', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'service2',
	'popup_title' => __('Service 2', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Servic3 Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['service3'] = array(
	'tag_close' => 'true',
	'params' => array(
		'size' => array(
			'type' => 'select',
			'def' => '1/4',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4'
			)
		),
		'type' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'' => 'default',
				'color' => 'color'
			)
		),
		'title' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Title', 'my_framework')
		),
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'href' => array(
			'type' => 'text',
			'def' => '#',
			'label' => __('Destinaion URL', 'my_framework')
		),
		'buttontext' => array(
			'type' => 'text',
			'def' => 'Read More',
			'label' => __('Button Text', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'service3',
	'popup_title' => __('Service 3', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Slider Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['slider'] = array(
	'tag_close' => 'false',
	'params' => array(
		'images' => array(
			'type' => 'gallery',
			'def' => 'id1,id2,id3',
			'label' => __('Images ID', 'my_framework')
		),
		'width' => array(
			'type' => 'text',
			'def' => '210',
			'label' => __('Width of Slider', 'my_framework')
		),
		'height' => array(
			'type' => 'text',
			'def' => '120',
			'label' => __('Height of slider', 'my_framework')
		),
		'effect' => array(
			'type' => 'select',
			'def' => 'fade',
			'label' => __('Effect', 'my_framework'),
			'options' => array(
				'sliceDown' => 'sliceDown',
				'sliceDownLeft' => 'sliceDownLeft',
				'sliceUp' => 'sliceUp',
				'sliceUpLeft' => 'sliceUpLeft',
				'sliceUpDown' => 'sliceUpDown',
				'sliceUpDownLeft' => 'sliceUpDownLeft',
				'fold' => 'fold',
				'fade' => 'fade',
				'random' => 'random',
				'slideInRight' => 'slideInRight',
				'slideInLeft' => 'slideInLeft',
				'boxRandom' => 'boxRandom',
				'boxRain' => 'boxRain',
				'boxRainReverse' => 'boxRainReverse',
				'boxRainGrow' => 'boxRainGrow',
				'boxRainGrowReverse' => 'boxRainGrowReverse'
			)
		),
		'align' => array(
			'type' => 'select',
			'def' => 'left',
			'label' => __('Align', 'my_framework'),
			'options' => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			)
		),
		'showcaption' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Caption', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'showborder' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display border', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'showdirection' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Direction', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'showcontrol' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Control', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		)
	),
	'shortcode' => 'slider',
	'popup_title' => __('Slider', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Social Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['social'] = array(
	'tag_close' => 'true',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'delicious' => 'Delicious',
				'deviantart' => 'Deviantart',
				'digg' => 'Digg',
				'facebook' => 'Facebook',
				'flickr' => 'Flickr',
				'lastfm' => 'Lastfm',
				'linkedin' => 'Linkedin',
				'picasa' => 'Picasa',
				'rss' => 'RSS',
				'stumbleupon' => 'Stumbleupon',
				'tumblr' => 'Tumblr',
				'twitter' => 'Twitter',
				'vimeo' => 'Vimeo',
				'youtube' => 'Youtube'
			)
		),
		'text' => array(
			'type' => 'text',
			'def' => 'Follow Me',
			'label' => __('Your text', 'my_framework')
		),
		'style' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Style', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'opened' => 'Opened'
			)
		),
		'class' => array(
			'type' => 'select',
			'def' => 'light',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'light' => 'Light',
				'dark' => 'Dark'
			)
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your link',
			'label' => __('URL of Social', 'my_framework')
		)
	),
	'shortcode' => 'social',
	'popup_title' => __('Social Icons', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Space Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['space'] = array(
	'tag_close' => 'false',
	'params' => array(
		'height' => array(
			'type' => 'text',
			'def' => '40px',
			'label' => __('Height (in px)', 'my_framework')
		)
	),
	'shortcode' => 'space',
	'popup_title' => __('Space', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Step Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['step'] = array(
	'tag_close' => 'true',
	'params' => array(
		'size' => array(
			'type' => 'select',
			'def' => '1/4',
			'label' => __('Size', 'my_framework'),
			'options' => array(
				'1/1' => '1/1',
				'1/2' => '1/2',
				'1/3' => '1/3',
				'1/4' => '1/4'
			)
		),
		'class' => array(
			'type' => 'select',
			'def' => 'topleft',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'topleft' => 'TopLeft',
				'topright' => 'TopRight',
				'bottomright' => 'BottomRight',
				'bottomleft' => 'BottomLeft',
			)
		),
		'number' => array(
			'type' => 'text',
			'def' => '1',
			'label' => __('Number', 'my_framework')
		),
		'title' => array(
			'type' => 'text',
			'def' => 'your title',
			'label' => __('Title', 'my_framework')
		),
		'icon' => array(
			'type' => 'icon',
			'def' => '',
			'label' => __('Icon', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		),
	),
	'shortcode' => 'step',
	'popup_title' => __('Step', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Stunning Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['stunning'] = array(
	'tag_close' => 'true',
	'params' => array(
		'class' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'' => 'Light',
				'dark' => 'Dark'
			)
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'bordercolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Border Color', 'my_framework')
		),
		'content' => array(
			'type' => 'textarea',
			'def' => 'your content',
			'label' => __('Content', 'my_framework')
		)
	),
	'shortcode' => 'stunning',
	'popup_title' => __('Stunning', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Tab Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['tab'] = array(
	'tag_close' => 'true',
	'params' => array(
		'type' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Type', 'my_framework'),
			'options' => array(
				'' => 'Default',
				'vertical' => 'Vertical'
			)
		),
		'titlecolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Title Text Color', 'my_framework')
		),
		'titlebackground' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Title Background Color', 'my_framework')
		),
		'titlebordercolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Title Border Color', 'my_framework')
		),
		'contentcolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Content Text Color', 'my_framework')
		),
		'contentbackground' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Content Background Color', 'my_framework')
		),
		'contentbordercolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Content Border Color', 'my_framework')
		)
	),
	'shortcode' => 'tab',
	'popup_title' => __('Tab', 'my_framework'),
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'type' => 'text',
				'def' => 'your title',
                'label' => __('Title', 'my_framework')
            ),
			'content' => array(
				'type' => 'textarea',
				'def' => 'your content',
				'label' => __('Content', 'my_framework')
			)
        ),
        'shortcode' => 'tab_item',
        'clone_button' => __('Add List', 'my_framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonial Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['testimonial'] = array(
	'tag_close' => 'false',
	'params' => array(
		'class' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Class', 'my_framework'),
			'options' => array(
				'' => 'Light',
				'dark' => 'Dark'
			)
		),
		'showcarousel' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Enable Carousel', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'effect' => array(
			'type' => 'select',
			'def' => 'scroll',
			'label' => __('Effect', 'my_framework'),
			'options' => array(
				'scroll' => 'Scroll',
				'directscroll' => 'Direct Scroll',
				'fade' => 'Fade',
				'crossfade' => 'Cross Fade',
				'cover' => 'Cover',
				'cover-fade' => 'Cover Fade',
				'uncover' => 'Uncover',
				'uncover-fade' => 'Uncover Fade',
				'none' => 'None'
			)
		),
		'navigation' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Navigation', 'my_framework'),
			'options' => array(
				'' => 'None',
				'direction' => 'Direction',
				'pagination' => 'Pagination'
			)
		),
		'showimage' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Display Image', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'number' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Number of Items', 'my_framework')
		),
		'contentlength' => array(
			'type' => 'text',
			'def' => '40',
			'label' => __('Length of Content', 'my_framework')
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		),
		'background' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Background Color', 'my_framework')
		),
		'infocolor' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Details Info Color', 'my_framework')
		)
	),
	'shortcode' => 'testimonial',
	'popup_title' => __('Testimonial', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['toggle'] = array(
	'tag_close' => 'true',
	'params' => array(
			'titlecolor' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Title Text Color', 'my_framework')
			),
			'titlebackground' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Title Background Color', 'my_framework')
			),
			'signcolor' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Sign Color', 'my_framework')
			),
			'signbackground' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Sign Background Color', 'my_framework')
			),
			'contentcolor' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Content Text Color', 'my_framework')
			),
			'contentbackground' => array(
				'type' => 'color',
				'def' => '',
				'label' => __('Content Background Color', 'my_framework')
			)
	),
	'shortcode' => 'toggle',
	'popup_title' => __('Toggle', 'my_framework'),
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'type' => 'text',
				'def' => 'your title',
                'label' => __('Title', 'my_framework')
            ),
			'active' => array(
				'type' => 'select',
				'def' => '',
				'label' => __('Item Status', 'my_framework'),
				'options' => array(
					'' => 'Close',
					'active' => 'Open'
				)
			),
			'content' => array(
				'type' => 'textarea',
				'def' => 'your content',
				'label' => __('Content', 'my_framework')
			)
        ),
        'shortcode' => 'to-item',
        'clone_button' => __('Add Toggle', 'my_framework')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Twitter Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['twitter'] = array(
	'tag_close' => 'false',
	'params' => array(
		'id' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Twitter ID', 'my_framework')
		),
		'consumerkey' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Consumer Key', 'my_framework')
		),
		'consumersecret' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Consumer Secret', 'my_framework')
		),
		'accesstoken' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Access Token', 'my_framework')
		),
		'accesstokensecret' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Access Token Secret', 'my_framework')
		),
		'showcarousel' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Enable Carousel', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'effect' => array(
			'type' => 'select',
			'def' => 'fade',
			'label' => __('Effect', 'my_framework'),
			'options' => array(
				'scroll' => 'Scroll',
				'directscroll' => 'Direct Scroll',
				'fade' => 'Fade',
				'crossfade' => 'Cross Fade',
				'cover' => 'Cover',
				'cover-fade' => 'Cover Fade',
				'uncover' => 'Uncover',
				'uncover-fade' => 'Uncover Fade',
				'none' => 'None'
			)
		),
		'number' => array(
			'type' => 'text',
			'def' => '3',
			'label' => __('Number of Tweet', 'my_framework')
		),
		'navigation' => array(
			'type' => 'select',
			'def' => '',
			'label' => __('Navigation', 'my_framework'),
			'options' => array(
				'' => 'none',
				'direction' => 'direction',
				'pagination' => 'pagination',
			)
		),
		'showbutton' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Show Button', 'my_framework'),
			'options' => array(
				'off' => 'Disable',
				'' => 'Enable',
			)
		),
		'buttontext' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Button Text', 'my_framework')
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		)
	),
	'shortcode' => 'twitter',
	'popup_title' => __('Twitter', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['vimeo'] = array(
	'tag_close' => 'false',
	'params' => array(
		'video' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Video URL on Vimeo', 'my_framework')
		),
		'width' => array(
			'type' => 'text',
			'def' => '210',
			'label' => __('Width of Video', 'my_framework')
		),
		'height' => array(
			'type' => 'text',
			'def' => '120',
			'label' => __('Height of Video', 'my_framework')
		),
		'align' => array(
			'type' => 'select',
			'def' => 'left',
			'label' => __('Align', 'my_framework'),
			'options' => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			)
		),
		'showborder' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Border', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'autoplay' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Enable Autoplay', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'portrait' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Portrait', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'title' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Title', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'byline' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Byline', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'color' => array(
			'type' => 'color',
			'def' => '',
			'label' => __('Text Color', 'my_framework')
		)
	),
	'shortcode' => 'vimeo',
	'popup_title' => __('Vimeo', 'my_framework')
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube Config
/*-----------------------------------------------------------------------------------*/

$pa_shortcodes['youtube'] = array(
	'tag_close' => 'false',
	'params' => array(
		'video' => array(
			'type' => 'text',
			'def' => '',
			'label' => __('Video URL on youtube', 'my_framework')
		),
		'width' => array(
			'type' => 'text',
			'def' => '210',
			'label' => __('Width of Video', 'my_framework')
		),
		'height' => array(
			'type' => 'text',
			'def' => '120',
			'label' => __('Height of Video', 'my_framework')
		),
		'align' => array(
			'type' => 'select',
			'def' => 'left',
			'label' => __('Align', 'my_framework'),
			'options' => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			)
		),
		'showborder' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Display Border', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		),
		'autoplay' => array(
			'type' => 'select',
			'def' => 'off',
			'label' => __('Enable Autoplay', 'my_framework'),
			'options' => array(
				'' => 'Enable',
				'off' => 'Disable'
			)
		)
	),
	'shortcode' => 'youtube',
	'popup_title' => __('Youtube', 'my_framework')
);