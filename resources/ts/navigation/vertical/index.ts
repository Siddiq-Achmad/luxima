import type { VerticalNavItems } from '@/@layouts/types'
import appAndPages from './app-and-pages'
import charts from './charts'
import dashboard from './dashboard'
import forms from './forms'
import master from './master'
import others from './others'
import uiElements from './ui-elements'

export default [...dashboard, ...master, ...appAndPages, ...uiElements, ...forms, ...charts, ...others] as VerticalNavItems
