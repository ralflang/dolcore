<?php
class Dolcore_Feed_Controller extends Horde_Controller_Base
{
    public function processRequest(Horde_Controller_Request $request, Horde_Controller_Response $response)
    {
        $injector = $this->getInjector();
        $parts = explode('/',$request->getPath());
        if (count($parts) > 2) {
            switch ($parts[3]) {
                case 'category':
                    $driver = $injector->getInstance('Dolcore_Factory_Driver')->create($injector);
                    $categories = $driver->getCategoriesApi();
                    $discussionApi = $driver->getDiscussionApi();
                    $category = $categories->getCategory($parts[4]);
                    /* Write a category's currently running Umfragen */
                    $now = new Horde_Date(time());

                    $template = $this->getInjector()->createInstance('Horde_Template');

                    $template->set('updated', $now->format(DATE_ATOM));
                    $template->set('category_caption', $category->getCaption());
                    $template->set('category_id', $parts[4]);

                    $discussions = array();

                    foreach ($discussionApi->listDiscussions(array('category' => $category->id)) as $discussion) {
                        $discussions[$discussion->id]['title'] = $discussion->text;
                        $discussions[$discussion->id]['details'] = $discussion->hintergrund;
                        $discussions[$discussion->id]['modified'] = $discussion->erstelldatum;
                    }
                    $template->set('discussions', $discussions);

                    $response->setBody($template->fetch(DOLCORE_TEMPLATES . '/feeds/atom.xml'));
                break;

                case 'categories':

                break;
            }
        }
    }
}
