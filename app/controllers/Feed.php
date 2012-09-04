<?php
class Dolcore_Feed_Controller extends Horde_Controller_Base
{
    public function processRequest(Horde_Controller_Request $request, Horde_Controller_Response $response)
    {
        $this->_mapper = $GLOBALS['injector']->getInstance('Horde_Routes_Mapper');
        $this->_matchDict = new Horde_Support_Array($this->_mapper->match($request->getPath()));

        $injector = $this->getInjector();

        switch ($this->_matchDict->action) {
            case 'category':
                $driver = $injector->getInstance('Dolcore_Factory_Driver')->create($injector);
                $categories = $driver->getCategoriesApi();
                $discussionApi = $driver->getDiscussionApi();
                $category = $categories->getCategory($this->_matchDict->category);
                /* Write a category's currently running Umfragen */
                $now = new Horde_Date(time());

                $template = $this->getInjector()->createInstance('Horde_Template');

                $template->set('updated', $now->format(DATE_ATOM));
                $template->set('category_caption', $category->getCaption());
                $template->set('category_id', $category->id);

                $discussions = array();

                foreach ($discussionApi->listDiscussions(array('category' => $category->id)) as $discussion) {
                    $discussions[$discussion->id]['title'] = $discussion->text;
                    $discussions[$discussion->id]['details'] = $discussion->hintergrund;
                    $discussions[$discussion->id]['modified'] = $discussion->erstelldatum;
                    $discussions[$discussion->id]['id'] = Dolcore::getUrlFor('discussion', array('discussion_id' => $discussion->id), true, true );
                    $discussions[$discussion->id]['url'] = Dolcore::getUrlFor('discussion', array('discussion_id' => $discussion->id), true, true );
                }
                $template->set('discussions', $discussions);

                $response->setBody($template->fetch(DOLCORE_TEMPLATES . '/feeds/atom.xml'));
            break;

            case 'categories':

            break;
        }

    }
}
