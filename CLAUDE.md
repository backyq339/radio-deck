# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Radio Deck is a Filament PHP plugin that transforms default radio buttons into selectable cards with icons, titles, and descriptions. It's a Laravel package built specifically for FilamentPHP applications.

**Current Version**: Compatible with Filament 4.0+ and Tailwind CSS 4.0+

## Development Commands

### Frontend Development
- `npm run dev` - Watch mode for both CSS and JavaScript development
- `npm run dev:styles` - Watch Tailwind CSS 4.0 compilation only
- `npm run dev:scripts` - Watch JavaScript build only

### Production Build
- `npm run build` - Build both CSS and JavaScript for production
- `npm run build:styles` - Build and minify CSS with Tailwind CSS 4.0, then purge unused styles
- `npm run build:scripts` - Build JavaScript for production

**Note**: Uses `@tailwindcss/cli` for Tailwind CSS 4.0 compilation instead of the traditional `tailwindcss` CLI.

### Testing
- `composer test` or `vendor/bin/pest` - Run PHP tests using Pest
- `vendor/bin/pest --coverage` - Run tests with coverage report

## Architecture

### Core Component Structure
- **Main Component**: `src/Forms/Components/RadioDeck.php` - The primary Filament form component
- **Intermediary Layer**: `src/Intermediary/IntermediaryRadio.php` - Base radio functionality
- **Contracts**: `src/Contracts/` - Interfaces for descriptions and icons functionality
- **Traits**: `src/Traits/` - Modular functionality for styling, attributes, and layout

### Frontend Assets
- **CSS**: `resources/css/index.css` - Tailwind CSS 4.0 entry point with `@import "tailwindcss"`
- **JavaScript**: `resources/js/index.js` - Component JavaScript functionality
- **View**: `resources/views/forms/components/radio-deck.blade.php` - Blade template
- **Compiled Assets**: `resources/dist/` - Built CSS and JS files

### Key Technical Details

#### Enum Integration
The component supports Laravel Enums that implement:
- `HasLabel` (Filament's interface)
- `HasDescriptions` (custom interface)
- `HasIcons` (custom interface)

#### Trait-Based Architecture
The component uses composition through traits for:
- `HasDirection` - Column/row layout control
- `HasExtraCardsAttributes` - Card HTML attributes
- `HasExtraOptionsAttributes` - Option HTML attributes
- `HasExtraDescriptionsAttributes` - Description HTML attributes
- `HasGap` - Spacing between elements
- `HasIconSizes` - Icon size customization
- `HasPadding` - Card padding control

#### Build System
- Uses esbuild for JavaScript bundling
- Tailwind CSS 4.0 with `@tailwindcss/cli` for styling (no PostCSS needed)
- Filament's purge tool for CSS optimization (using v3.x compatibility mode)
- npm-run-all for parallel task execution

#### Important Notes for Filament 4
- **Method Conflict**: The `HasGap` trait includes a compatibility layer for Filament 4's new `gap()` method
- **Service Providers**: Removed deprecated service providers (`FilamentServiceProvider`, `TablesServiceProvider`, `WidgetsServiceProvider`)
- **PHP Requirements**: Minimum PHP 8.2+ required for Filament 4
- **Laravel Version**: Minimum Laravel 11.28+ required

## Testing Framework
Uses Pest PHP testing framework with:
- Architecture testing via `pestphp/pest-plugin-arch`
- Laravel-specific testing via `pestphp/pest-plugin-laravel`
- Orchestra Testbench for package testing

## Code Standards
- Follows PSR-2 coding standards
- Requires tests for all new features
- Uses semantic versioning (SemVer)
- One feature per pull request