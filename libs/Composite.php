<?php


/**
 * namespace Composite
 * base class đóng vai trò là component 
 * để render Menu và submenu ở View
 */

 namespace app\core;

 /**
  * Giao diện MenuComponent
  * Khai báo các phương thức chung cho cả các đối tượng đơn giản và phức tạp trong cấu trúc menu.
  */
 interface MenuComponent
 {
     public function render();
 }
 
 /**
  * Lớp MenuItem
  * Đại diện cho một mục menu đơn (nút lá trong cấu trúc composite).
  */
 class MenuItem implements MenuComponent
 {
     private string $title;
     private string $link;
 
     public function __construct(string $title, string $link)
     {
         $this->title = $title;
         $this->link = $link;
     }
 
     public function render()
     {
         return "<li><a href='{$this->link}'>{$this->title}</a></li>";
     }
 }
 
 /**
  * Lớp MenuComposite
  * Đại diện cho một mục menu phức tạp có thể chứa các MenuComponent khác (cả MenuItem hoặc menu con).
  */
 class MenuComposite implements MenuComponent
 {
     private string $title;
     private array $children = [];
 
     public function __construct(string $title)
     {
         $this->title = $title;
     }
 
     // Thêm một thành phần con vào menu
     public function add(MenuComponent $component)
     {
         $this->children[] = $component;
     }
 
     // Xóa một thành phần con khỏi menu
     public function remove(MenuComponent $component)
     {
         $this->children = array_filter(
             $this->children,
             fn($child) => $child !== $component
         );
     }
 
     // Phương thức render để hiển thị menu và các mục con
     public function render()
     {
         $html = "<li>{$this->title}<ul>";
         foreach ($this->children as $child) {
             $html .= $child->render();
         }
         $html .= "</ul></li>";
         return $html;
     }
 }
 
 /**
  * Lớp MenuRenderer
  * Được sử dụng để render toàn bộ cấu trúc menu.
  */
 class MenuRenderer
 {
     private MenuComposite $rootMenu;
 
     public function __construct(MenuComposite $rootMenu)
     {
         $this->rootMenu = $rootMenu;
     }
 
     public function render()
     {
         echo "<ul>" . $this->rootMenu->render() . "</ul>";
     }
 }
 
 // Ví dụ sử dụng
 $mainMenu = new MenuComposite("Main Menu");
 
 $dashboard = new MenuItem("Dashboard", "/dashboard");
 $profile = new MenuItem("Profile", "/profile");
 
 $settingsMenu = new MenuComposite("Settings");
 $accountSettings = new MenuItem("Account", "/settings/account");
 $privacySettings = new MenuItem("Privacy", "/settings/privacy");
 
 $settingsMenu->add($accountSettings);
 $settingsMenu->add($privacySettings);
 
 $mainMenu->add($dashboard);
 $mainMenu->add($profile);
 $mainMenu->add($settingsMenu);
 
 $menuRenderer = new MenuRenderer($mainMenu);
 $menuRenderer->render();
 
 

 

//  // The component interface declares common operations for both
// // simple and complex objects of a composition.
// interface Graphic is
// method move(x, y)
// method draw()

// // The leaf class represents end objects of a composition. A
// // leaf object can't have any sub-objects. Usually, it's leaf
// // objects that do the actual work, while composite objects only
// // delegate to their sub-components.
// class Dot implements Graphic is
// field x, y

// constructor Dot(x, y) { ... }

// method move(x, y) is
//     this.x += x, this.y += y

// method draw() is
//     // Draw a dot at X and Y.

// // All component classes can extend other components.
// class Circle extends Dot is
// field radius

// constructor Circle(x, y, radius) { ... }

// method draw() is
//     // Draw a circle at X and Y with radius R.

// // The composite class represents complex components that may
// // have children. Composite objects usually delegate the actual
// // work to their children and then "sum up" the result.
// class CompoundGraphic implements Graphic is
// field children: array of Graphic

// // A composite object can add or remove other components
// // (both simple or complex) to or from its child list.
// method add(child: Graphic) is
//     // Add a child to the array of children.

// method remove(child: Graphic) is
//     // Remove a child from the array of children.

// method move(x, y) is
//     foreach (child in children) do
//         child.move(x, y)

// // A composite executes its primary logic in a particular
// // way. It traverses recursively through all its children,
// // collecting and summing up their results. Since the
// // composite's children pass these calls to their own
// // children and so forth, the whole object tree is traversed
// // as a result.
// method draw() is
//     // 1. For each child component:
//     //     - Draw the component.
//     //     - Update the bounding rectangle.
//     // 2. Draw a dashed rectangle using the bounding
//     // coordinates.


// // The client code works with all the components via their base
// // interface. This way the client code can support simple leaf
// // components as well as complex composites.
// class ImageEditor is
// field all: CompoundGraphic

// method load() is
//     all = new CompoundGraphic()
//     all.add(new Dot(1, 2))
//     all.add(new Circle(5, 3, 10))
//     // ...

// // Combine selected components into one complex composite
// // component.
// method groupSelected(components: array of Graphic) is
//     group = new CompoundGraphic()
//     foreach (component in components) do
//         group.add(component)
//         all.remove(component)
//     all.add(group)
//     // All components will be drawn.
//     all.draw()