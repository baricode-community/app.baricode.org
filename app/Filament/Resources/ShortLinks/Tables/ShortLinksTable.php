<?php

namespace App\Filament\Resources\ShortLinks\Tables;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class ShortLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug copied!')
                    ->prefix('/link/')
                    ->badge()
                    ->color('info'),
                TextColumn::make('real_url')
                    ->label('Destination URL')
                    ->limit(50)
                    ->searchable()
                    ->url(fn ($record) => $record->real_url)
                    ->openUrlInNewTab()
                    ->toggleable(),
                TextColumn::make('click_count')
                    ->label('Clicks')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                TextColumn::make('expired_at')
                    ->label('Expires')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->placeholder('Never')
                    ->color(fn ($record) => $record?->isExpired() ? 'danger' : null),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->label('Status'),
                Filter::make('expired')
                    ->label('Expired')
                    ->query(fn (Builder $query) => $query->whereNotNull('expired_at')->where('expired_at', '<', now())),
                Filter::make('never_expires')
                    ->label('Never Expires')
                    ->query(fn (Builder $query) => $query->whereNull('expired_at')),
            ])
            ->recordActions([
                Action::make('qrcode')
                    ->label('QR Code')
                    ->icon('heroicon-o-qr-code')
                    ->color('gray')
                    ->modalHeading(fn ($record) => 'QR Code — /link/'.$record->slug)
                    ->modalContent(function ($record) {
                        $url = config('app.url').'/link/'.$record->slug;
                        $renderer = new ImageRenderer(
                            new RendererStyle(300),
                            new SvgImageBackEnd
                        );
                        $svg = (new Writer($renderer))->writeString($url);
                        $dataUrl = 'data:image/svg+xml;base64,'.base64_encode($svg);

                        return new HtmlString(
                            '<div class="flex flex-col items-center gap-4 py-2">'
                            .'<div class="rounded-xl border border-gray-200 dark:border-gray-700 p-3 bg-white">'
                            .$svg
                            .'</div>'
                            .'<p class="text-sm text-gray-500 break-all">'.$url.'</p>'
                            .'<a href="'.$dataUrl.'" download="qrcode-'.$record->slug.'.svg"'
                            .' style="display:inline-block;padding:10px 28px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;font-size:14px;font-weight:600;text-decoration:none;border-radius:10px;box-shadow:0 4px 14px rgba(99,102,241,0.4);letter-spacing:0.03em;transition:all .15s ease"'
                            .' onmouseover="this.style.boxShadow=\'0 6px 20px rgba(99,102,241,0.55)\';this.style.transform=\'translateY(-1px)\'"'
                            .' onmouseout="this.style.boxShadow=\'0 4px 14px rgba(99,102,241,0.4)\';this.style.transform=\'translateY(0)\'">'
                            .'Download QR Code'
                            .'</a>'
                            .'</div>'
                        );
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
