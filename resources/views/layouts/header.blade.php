<?php
$activeMenuItem = isset($activeMenuItem) ? $activeMenuItem : '';
$activeSubMenuItem = isset($activeSubMenuItem) ? $activeSubMenuItem : '';
?>

<header class="top-header">
    <nav class="nav-bar">
        <div class="nav-bar-extras">
            <button id="navbar-toggler" class="nav-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <h1 class="logo">
            <a class="logo-link i-gsv-top" href="/"><span>Gereformeerde Studentenvereniging Groningen</span></a>
        </h1>
        <ul id="main-menu" class="nav-bar-links">
<?php
foreach($menu as $name => $item)
{
    $itemClassNames = ['top-level-menuitem'];
    $title = '';
    $params = '';

    // Check if item is not visible
    if(array_key_exists('visible', $item) && is_callable($item['visible']) && !$item['visible']())
    {
        continue;
    }

    // Get the title
    if(is_callable($item['title']))
    {
        $title = $item['title']();
    } else
    {
        $title = $item['title'];
    }

    // Add submenu class
    if(array_key_exists('submenu', $item))
    {
        $itemClassNames[] = 'has-sub-menu';
    }

    // Check if menu is active
    if($name == $activeMenuItem)
    {
        $itemClassNames[] = 'active-menu';
    }

    if(array_key_exists('params', $item) && is_array($item['params']))
    {
        $params = '';
        foreach($item['params'] as $key => $value)
        {
            $params .= ' ' . $key . '="' . $value . '"';
        }
    }

    // Print the item
    echo '<li class="' . implode(' ', $itemClassNames) . '">';
    echo '<a class="top-level-link" href="' . htmlentities($item['url']) . '"'. $params . '>' . $title . '</a>';
    
    // Show sub menu
    if(array_key_exists('submenu', $item))
    {
        echo '<span class="top-caret"><i class="caret"></i></span>';
        echo '<ul class="sub-level-menu">';
        foreach($item['submenu'] as $subItem)
        {
            // Check if item is not visible
            if(array_key_exists('visible', $subItem) && is_callable($subItem['visible']) && !$subItem['visible']())
            {
                continue;
            }

            if(array_key_exists('params', $subItem) && is_array($subItem['params']))
            {
                $params = '';
                foreach($subItem['params'] as $key => $value)
                {
                    $params .= ' ' . $key . '="' . $value . '"';
                }
            }

            // Print item
            echo '<li><a class="sub-level-link" href="' . htmlentities($subItem['url']) . '"' . $params . '>' . htmlentities($subItem['title']) . '</a></li>';
        }
        echo '</ul>';

    }

    echo '</li>';

}
?>
    </ul>
    </nav>
</header>