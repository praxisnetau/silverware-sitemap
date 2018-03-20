<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Sitemap\Pages
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2018 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-sitemap
 */

namespace SilverWare\Sitemap\Pages;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\SelectionGroup;
use SilverStripe\Forms\SelectionGroup_Item;
use SilverWare\FontIcons\Forms\FontIconField;
use SilverWare\Forms\FieldSection;
use SilverWare\Forms\PageDropdownField;
use SilverWare\Forms\PageMultiselectField;
use Page;

/**
 * An extension of the page class for a sitemap page.
 *
 * @package SilverWare\Sitemap\Pages
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2018 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-sitemap
 */
class SitemapPage extends Page
{
    /**
     * Define mode constants.
     */
    const MODE_ALL      = 'all';
    const MODE_CHILDREN = 'children';
    const MODE_SELECTED = 'selected';
    
    /**
     * Define title constants.
     */
    const TITLE_MENU = 'menu';
    const TITLE_PAGE = 'page';
    
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Sitemap Page';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Sitemap Pages';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'Generates a sitemap of the pages within the site';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware/sitemap: admin/client/dist/images/icons/SitemapPage.png';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_SitemapPage';
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'Mode' => 'Varchar(16)',
        'LinkIcon' => 'FontIcon',
        'LinkText' => 'Varchar(16)',
        'TitleText' => 'Varchar(16)'
    ];
    
    /**
     * Defines the has-one associations for this object.
     *
     * @var array
     * @config
     */
    private static $has_one = [
        'ParentPage' => Page::class
    ];
    
    /**
     * Defines the many-many associations for this object.
     *
     * @var array
     * @config
     */
    private static $many_many = [
        'SelectedPages' => Page::class
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'Mode' => self::MODE_ALL,
        'LinkIcon' => 'chevron-right',
        'LinkText' => self::TITLE_MENU,
        'TitleText' => self::TITLE_PAGE
    ];
    
    /**
     * Answers a list of field objects for the CMS interface.
     *
     * @return FieldList
     */
    public function getCMSFields()
    {
        // Obtain Field Objects (from parent):
        
        $fields = parent::getCMSFields();
        
        // Create Styles Tab:
        
        $fields->findOrMakeTab(
            'Root.Styles',
            $this->fieldLabel('Styles')
        );
        
        // Create Styles Fields:
        
        $fields->addFieldsToTab(
            'Root.Styles',
            [
                FieldSection::create(
                    'SitemapStyles',
                    $this->fieldLabel('Sitemap'),
                    [
                        FontIconField::create(
                            'LinkIcon',
                            $this->fieldLabel('LinkIcon')
                        )
                    ]
                )
            ]
        );
        
        // Create Options Tab:
        
        $fields->findOrMakeTab(
            'Root.Options',
            $this->fieldLabel('Options')
        );
        
        // Create Options Fields:
        
        $fields->addFieldsToTab(
            'Root.Options',
            [
                FieldSection::create(
                    'SitemapOptions',
                    $this->fieldLabel('Sitemap'),
                    [
                        SelectionGroup::create(
                            'Mode',
                            [
                                SelectionGroup_Item::create(
                                    self::MODE_ALL,
                                    null,
                                    $this->fieldLabel('All')
                                ),
                                SelectionGroup_Item::create(
                                    self::MODE_CHILDREN,
                                    PageDropdownField::create(
                                        'ParentPageID',
                                        ''
                                    )->setRightTitle(
                                        _t(
                                            __CLASS__ . '.PARENTPAGEIDRIGHTTITLE',
                                            'Shows the child pages of the selected parent page.'
                                        )
                                    ),
                                    $this->fieldLabel('Children')
                                ),
                                SelectionGroup_Item::create(
                                    self::MODE_SELECTED,
                                    PageMultiselectField::create(
                                        'SelectedPages',
                                        ''
                                    )->setRightTitle(
                                        _t(
                                            __CLASS__ . '.SELECTEDPAGESRIGHTTITLE',
                                            'Shows only those pages selected above.'
                                        )
                                    ),
                                    $this->fieldLabel('Selected')
                                )
                            ]
                        )->setTitle($this->fieldLabel('Mode')),
                        DropdownField::create(
                            'LinkText',
                            $this->fieldLabel('LinkText'),
                            $this->getTitleOptions()
                        ),
                        DropdownField::create(
                            'TitleText',
                            $this->fieldLabel('TitleText'),
                            $this->getTitleOptions()
                        )
                    ]
                )
            ]
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers the labels for the fields of the receiver.
     *
     * @param boolean $includerelations Include labels for relations.
     *
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        // Obtain Field Labels (from parent):
        
        $labels = parent::fieldLabels($includerelations);
        
        // Define Field Labels:
        
        $labels['All'] = _t(__CLASS__ . '.ALL', 'All');
        $labels['Mode'] = _t(__CLASS__ . '.MODE', 'Mode');
        $labels['Options'] = _t(__CLASS__ . '.OPTIONS', 'Options');
        $labels['Sitemap'] = _t(__CLASS__ . '.SITEMAP', 'Sitemap');
        $labels['Children'] = _t(__CLASS__ . '.CHILDREN', 'Children');
        $labels['LinkIcon'] = _t(__CLASS__ . '.LINKICON', 'Link icon');
        $labels['LinkText'] = _t(__CLASS__ . '.LINKTEXT', 'Link text');
        $labels['Selected'] = _t(__CLASS__ . '.SELECTED', 'Selected');
        $labels['TitleText'] = _t(__CLASS__ . '.TITLETEXT', 'Title text');
        $labels['ParentPageID'] = _t(__CLASS__ . '.PARENTPAGE', 'Parent Page');
        
        // Define Relation Labels:
        
        if ($includerelations) {
            $labels['ParentPage'] = _t(__CLASS__ . '.has_one_ParentPage', 'Parent Page');
            $labels['SelectedPages'] = _t(__CLASS__ . '.many_many_SelectedPages', 'Selected Pages');
        }
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers the sitemap data list for the template.
     *
     * @return DataList
     */
    public function getSitemap()
    {
        switch ($this->Mode) {
            case self::MODE_CHILDREN:
                $pages = $this->getChildPages();
                break;
            case self::MODE_SELECTED:
                $pages = $this->SelectedPages();
                break;
            default:
                $pages = $this->getTopLevelPages();
        }
        
        if ($pages) {
            $pages = $pages->exclude('ID', $this->ID);
        }
        
        return $pages;
    }
    
    /**
     * Answers a data list containing the children of the defined parent page.
     *
     * @return DataList
     */
    public function getChildPages()
    {
        if ($this->ParentPage()->isInDB()) {
            return $this->ParentPage()->Children();
        }
    }
    
    /**
     * Answers a data list containing the top-level pages of the site.
     *
     * @return DataList
     */
    public function getTopLevelPages()
    {
        return Page::get()->filter([
            'ParentID' => 0,
            'ShowInMenus' => 1
        ]);
    }
    
    /**
     * Answers an array of options for title fields.
     *
     * @return array
     */
    public function getTitleOptions()
    {
        return [
            self::TITLE_MENU => _t(__CLASS__ . '.NAVIGATIONLABEL', 'Navigation label'),
            self::TITLE_PAGE => _t(__CLASS__ . '.PAGENAME', 'Page name')
        ];
    }
    
    /**
     * Answers a message string to be shown when no data is available.
     *
     * @return string
     */
    public function getNoDataMessage()
    {
        return _t(__CLASS__ . '.NODATAAVAILABLE', 'No data available.');
    }
}
